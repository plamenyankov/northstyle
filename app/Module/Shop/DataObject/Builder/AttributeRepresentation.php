<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\AttributeRepresentation as Model;

use Northstyle\Module\Shop\DataObject\AttributeRepresentation as DataObject;

class AttributeRepresentation {
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