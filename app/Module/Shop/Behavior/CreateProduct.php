<?php

namespace Northstyle\Module\Shop\Behavior;

use Common\Behavior;

use Module\Products\Model\Store as StoreModel;
use Module\Products\Model\Product as ProductModel;

use Module\Products\DataObject\Product as ProductDataObject;

class CreateProduct extends Behavior {
	public function handle(StoreModel $store, ProductModel $product, ProductDataObject $productDO) {
		$store->products()->add($product);
	}
}