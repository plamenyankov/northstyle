<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Core\Model\ObjectValue as ObjectValueModel;

use Northstyle\Module\Shop\Model\Store as StoreModel;
use Northstyle\Module\Shop\Model\AttributeSet as AttributeSetModel;
use Northstyle\Module\Shop\Model\Product as Model;

use Northstyle\Module\Shop\Behavior\DataObject\CreateProduct as CreateBehaviorDO;

class CreateProduct extends Behavior {

	protected $storeModel = null;

	protected $attributeSetModel = null;

	public function __construct(StoreModel $storeModel, AttributeSetModel $attributeSetModel) {
		$this->storeModel = $storeModel;
		$this->attributeSetModel = $attributeSetModel;
	}

	public function loadStoreById($storeID) {
		$loadedEntity = $this->storeModel->find($storeID);

		return $loadedEntity;
	}

	public function loadAttributeSetById($setID) {
		$loadedEntity = $this->storeModel->find($setID);

		return $loadedEntity;
	}

	public function valueEntity($type, $valueDO) {
		$valueEntity = new ObjectValueModel();
		$valueEntity->object_type = $type;
		$valueEntity->name = $valueDO->name;
		$valueEntity->value = $valueDO->value;

		return $valueEntity;
	}

	public function handle(CreateBehaviorDO $do) {
		$entity = new Model();

		$entity->attributeSet()->associate($this->loadAttributeSetById($do->attribute_set_id));
		$entity->store()->associate($this->loadStoreById($do->store_id));
		$entity->save();

		if (count($do->values)) {
			foreach ($do->values as $valueDO) {
				$entity->values()->save($this->valueEntity(Model::OBJECT_TYPE, $valueDO));
			}
		}
	}
}