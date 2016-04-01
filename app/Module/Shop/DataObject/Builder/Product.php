<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\Product as ProductModel;

use Northstyle\Module\Core\DataObject\Builder\ObjectValue as ObjectValueBuilder;

use Northstyle\Module\Shop\DataObject\Product as ProductDO;

class Product {
	protected $attributeSetBuilder = null;

	public function __construct(ObjectValueBuilder $objectValueBuilder, AttributeSet $attributeSetBuilder) {
		$this->objectValueBuilder = $objectValueBuilder;
		$this->attributeSetBuilder = $attributeSetBuilder;
	}

	public function build(ProductModel $entity = null) {
		$do = new ProductDO();

		if ($entity) {
			$entityData = $entity->toArray();
			$entityData['attribute_set'] = $this->attributeSetBuilder->build($entity->attributeSet);

			if (count($entity->values)) {
				$entityData['values'] = $this->objectValueBuilder->buildThem($entity->values);
			}

			$do->update($entityData);
		}

		return $do;
	}
}