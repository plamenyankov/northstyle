<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\AttributeOption as Model;

use Northstyle\Module\Core\DataObject\Builder\ObjectValue as ObjectValueBuilder;

use Northstyle\Module\Shop\DataObject\AttributeOption as DataObject;

class AttributeOption {
	protected $objectValueBuilder = null;

	public function __construct(ObjectValueBuilder $objectValueBuilder) {
		$this->objectValueBuilder = $objectValueBuilder;
	}

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

			if (count($entity->values)) {
				$entityData['values'] = $this->objectValueBuilder->buildThem($entity->values);
			}

			$do->update($entity->toArray());
		}

		return $do;
	}
}