<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Behavior\DataObject\RemoveStoreView as RemoveBehaviorDO;

use Northstyle\Module\Shop\Model\StoreView as Model;

class RemoveStoreView extends Behavior {
	protected $model = null;

	public function __construct(Model $model) {
		$this->model = $model;
	}

	public function handle(RemoveBehaviorDO $do) {
		$entity = $this->model->find($do->id->value());

		$entity->delete();
	}
}