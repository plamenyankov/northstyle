<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\AttributeSet as Model;

use Northstyle\Module\Shop\DataObject\AttributeSet as DataObject;

class AttributeSet {
	protected $attributeBuilder = null;

	public function __construct(Attribute $attributeBuilder) {
		$this->attributeBuilder = $attributeBuilder;
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

			$entityData['attributes'] = $this->attributeBuilder->buildThem($entity->attributes);

			$do->update($entityData);
		}

		return $do;
	}
}