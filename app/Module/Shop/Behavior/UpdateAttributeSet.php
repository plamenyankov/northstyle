<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Model\Store as StoreModel;

use Northstyle\Module\Shop\Behavior\DataObject\UpdateAttributeSet as UpdateBehaviorDO;

use Northstyle\Module\Shop\Model\AttributeSet as Model;

class UpdateAttributeSet extends Behavior {
	protected $model = null;

	protected $storeModel = null;

	public function __construct(Model $model, StoreModel $storeModel) {
		$this->model = $model;
		$this->storeModel = $storeModel;
	}

	public function handle(UpdateBehaviorDO $do) {
		$entity = $this->model->find($do->id->value());

		if (!$entity) {
			throw new EntityNotFoundException('Entity Not Found');
		}

		$entity->label = $do->label;
		$entity->save();
	}
}