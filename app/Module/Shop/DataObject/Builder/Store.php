<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\Store as StoreModel;

use Northstyle\Module\Shop\DataObject\Store as StoreDO;

class Store {
	public function build(StoreModel $entity = null) {
		$do = new StoreDO();

		if ($entity) {
			$do->update($entity->toArray());
		}

		return $do;
	}
}