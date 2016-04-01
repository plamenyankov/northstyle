<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Model\AttributeSet as AttributeSetModel;

use Northstyle\Module\Shop\Model\Attribute as Model;
use Northstyle\Module\Shop\Model\AttributeOption as AttributeOptionModel;
use Northstyle\Module\Shop\Model\AttributeRepresentation as AttributeRepresentationModel;

use Northstyle\Module\Core\Model\ObjectValue as ObjectValueModel;

use Northstyle\Module\Shop\Behavior\DataObject\CreateAttribute as CreateBehaviorDO;

use Northstyle\Exception\EntityNotFound as EntityNotFoundException;

class CreateAttribute extends Behavior {

	protected $attributeSetModel = null;

	protected $representationModel = null;

	public function __construct(AttributeSetModel $attributeSetModel, AttributeRepresentationModel $representationModel) {
		$this->attributeSetModel = $attributeSetModel;
		$this->representationModel = $representationModel;
	}

	public function loadAttributeSetById($setID) {
		$loadedEntity = $this->attributeSetModel->find($setID->value());

		if (!$loadedEntity) {
			throw new EntityNotFoundException('Entity Not Found');
		}

		return $loadedEntity;
	}

	public function loadRepresentationEntity($representationID) {
		$entity = $this->representationModel->find($representationID->value());

		if (!$entity) {
			throw new EntityNotFoundException('Entity Not Found');
		}

		return $entity;
	}

	public function optionEntity($optionDO) {
		$optionEntity = new AttributeOptionModel();
		$optionEntity->name = $optionDO->name;
		$optionEntity->label = $optionDO->label;

		return $optionEntity;
	}

	public function valueEntity($type, $valueDO) {
		$valueEntity = new ObjectValueModel();
		$valueEntity->object_type = $type;
		$valueEntity->name = $valueDO->name;
		$valueEntity->value = $valueDO->value;

		return $valueEntity;
	}

	public function handle(CreateBehaviorDO $do) {
		\DB::transaction(function() use($do) {
			$entity = new Model();

			$entity->attributeSet()->associate($this->loadAttributeSetById($do->attribute_set_id));
			$entity->representation()->associate($this->loadRepresentationEntity($do->representation_id));

			$entity->name = $do->name;
			$entity->label = $do->label;
			$entity->default_value = $do->default_value;
			$entity->max_values_count = $do->max_values_count;
			$entity->required_create = $do->required_create;
			$entity->required_order = $do->required_order;

			$entity->save();

			if (count($do->options)) {
				foreach ($do->options as $optionDO) {
					$optionEntity = $this->optionEntity($optionDO);
					$entity->options()->save($optionEntity);

					foreach ($optionDO->values as $valueDO) {
						$valueEntity = $this->valueEntity(AttributeOptionModel::OBJECT_TYPE, $valueDO);
						
						$optionEntity->values()->save($valueEntity);
					}
				}

				$entity->options()->save($optionEntity);
			}

			if (count($do->values)) {
				foreach ($do->values as $valueDO) {
					$entity->objectValues()->save($this->valueEntity(Model::OBJECT_TYPE, $valueDO));
				}
			}
		});
	}
}