<?php

namespace Northstyle\Module\Core\DataObject\Builder;

use Northstyle\Module\Core\Model\ObjectValue as Model;

use Northstyle\Module\Core\DataObject\ObjectValue as DataObject;

class ObjectValue {
	public function buildThem($collection) {
		$dos = array();

		if (count($collection)) {
			foreach ($collection as $item) {
				$dos[] = $this->build($item);
			}
		}

		return $dos;
	}

	public function build(Model $entity = null) {
		$do = new DataObject();

		if ($entity) {
			$entityData = $entity->toArray();

			$do->update($entityData);
		}

		return $do;
	}
}