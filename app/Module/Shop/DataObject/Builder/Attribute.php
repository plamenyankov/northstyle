<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Shop\Model\Attribute as Model;

use Northstyle\Module\Core\DataObject\Builder\ObjectValue as ObjectValueBuilder;

use Northstyle\Module\Shop\DataObject\Builder\AttributeOption as AttributeOptionBuilder;

use Northstyle\Module\Shop\DataObject\Builder\AttributeRepresentation as AttributeRepresentationBuilder;

use Northstyle\Module\Shop\DataObject\Attribute as DataObject;

class Attribute {
	protected $objectValueBuilder = null;

	protected $attributeOptionBuilder = null;

	protected $representationBuilder = null;

	public function __construct(ObjectValueBuilder $objectValueBuilder, AttributeOptionBuilder $attributeOptionBuilder, AttributeRepresentationBuilder $representationBuilder) {
		$this->objectValueBuilder = $objectValueBuilder;
		$this->attributeOptionBuilder = $attributeOptionBuilder;
		$this->representationBuilder = $representationBuilder;
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

	public function generateEntityUrl($entity) {
		return route('backend.shop.store.attribute_set.attribute.edit', array(
			'store_id' => $entity->attributeSet->store_id,
			'attribute_set_id' => $entity->attribute_set_id,
			'attribute_id' => $entity->id
		));
	}

	public function build(Model $entity = null) {
		$do = new DataObject();

		if ($entity) {
			$entityData = $entity->toArray();

			$entityData['representation'] = $this->representationBuilder->build($entity->representation);

			$entityData['representation_id'] = $entityData['attribute_representation_id'];

			$entityData['edit_url'] = $this->generateEntityUrl($entity);

			if (count($entity->values)) {
				$entityData['values'] = $this->objectValueBuilder->buildThem($entity->values);
			}

			if (count($entity->options)) {
				$entityData['options'] = $this->attributeOptionBuilder->buildThem($entity->options);
			}

			$do->update($entityData);
		}

		return $do;
	}
}