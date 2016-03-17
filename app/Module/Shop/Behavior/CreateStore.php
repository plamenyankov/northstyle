<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Model\Store as StoreModel;

use Northstyle\Module\Shop\Behavior\DataObject\CreateStore as CreateStoreDO;

class CreateStore extends Behavior {
	public function handle(CreateStoreDO $do) {
		$store = new StoreModel();
		$store->label = $do->label;
		$store->save();
	}
}