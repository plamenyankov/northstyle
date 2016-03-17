<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\Product as ProductModel;

use Northstyle\Module\Shop\DataObject\Product as ProductDO;

class Product {
	public function build(ProductModel $entity = null) {
		$do = new ProductDO();

		if ($entity) {
			$do->update($entity->toArray());
		}

		return $do;
	}
}