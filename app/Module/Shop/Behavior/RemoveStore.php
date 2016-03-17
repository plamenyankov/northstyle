<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Behavior\DataObject\RemoveStore as RemoveStoreDO;

use Northstyle\Module\Shop\Model\Store as StoreModel;

class RemoveStore extends Behavior {
	protected $model = null;

	public function __construct(StoreModel $model) {
		$this->model = $model;
	}

	public function handle(RemoveStoreDO $do) {
		$entity = $this->model->find($do->store_id->value());

		$entity->delete();		
	}
}