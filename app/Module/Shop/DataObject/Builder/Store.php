<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\Store as StoreModel;

use Northstyle\Module\Shop\DataObject\Store as StoreDO;

class Store {
	protected $storeViewBuilder;

	protected $attributeSetBuilder;

	public function __construct(StoreView $storeViewBuilder, AttributeSet $attributeSetBuilder) {
		$this->storeViewBuilder = $storeViewBuilder;
		$this->attributeSetBuilder = $attributeSetBuilder;
	}

	public function build(StoreModel $entity = null) {
		$do = new StoreDO();

		if ($entity) {
			$entityData = $entity->toArray();
			$entityData['views'] = $this->storeViewBuilder->buildThem($entity->views);
			$entityData['attribute_sets'] = $this->attributeSetBuilder->buildThem($entity->attributeSets);

			$do->update($entityData);
		}

		return $do;
	}
}