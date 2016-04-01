<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\ObjectValue as Model;

use Northstyle\Module\Shop\DataObject\ObjectValue as DataObject;

class ObjectValue {
	public function build(Model $entity = null) {
		$do = new DataObject();

		if ($entity) {
			$entityData = $entity->toArray();

			$do->update($entity->toArray());
		}

		return $do;
	}
}