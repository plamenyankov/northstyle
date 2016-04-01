<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Core\Model\ObjectValue as ObjectValueModel;

use Northstyle\Module\Shop\Model\Product as Model;

use Northstyle\Module\Shop\Behavior\DataObject\UpdateProduct as UpdateBehaviorDO;

class UpdateProduct extends Behavior {
	protected $productModel = null;

	public function __construct(Model $productModel) {
		$this->productModel = $productModel;
	}

	public function loadProductEntityById($id) {
		$entity = $this->productModel->find($id);

		if (!$entity) {
			throw new EntityNotFoundException('Entity Not Found');
		}

		return $entity;
	}

	public function valueEntity($type, $valueDO) {
		$valueEntity = new ObjectValueModel();
		$valueEntity->object_type = $type;
		$valueEntity->name = $valueDO->name;
		$valueEntity->value = $valueDO->value;

		return $valueEntity;
	}

	public function handle(UpdateBehaviorDO $do) {
		\DB::transaction(function() use ($do) {
			$entity = $this->loadProductEntityById($do->id->value());
			$entity->save();

			if (count($do->values)) {
				$entity->values()->delete();

				foreach ($do->values as $valueDO) {
					$entity->values()->save($this->valueEntity(Model::OBJECT_TYPE, $valueDO));
				}
			}
		});
	}
}