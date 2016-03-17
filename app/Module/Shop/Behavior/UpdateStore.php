<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Behavior\DataObject\UpdateStore as UpdateStoreDO;

use Northstyle\Module\Shop\Model\Store as StoreModel;

class UpdateStore extends Behavior {
	protected $model = null;

	public function __construct(StoreModel $model) {
		$this->model = $model;
	}

	public function handle(UpdateStoreDO $do) {
		$store = $this->model->find($do->store_id->value());

		if (!$store) {
			throw new EntityNotFoundException('Entity Not Found');
		}

		$store->label = $do->label;
		$store->save();
	}
}