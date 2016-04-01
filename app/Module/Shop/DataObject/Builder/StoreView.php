<?php

namespace Northstyle\Module\Shop\DataObject\Builder;

use Northstyle\Module\Core\DataObject\Builder\Language as LanguageBuilder;

use Northstyle\Module\Shop\Model\StoreView as Model;

use Northstyle\Module\Shop\DataObject\StoreView as DataObject;

class StoreView {
	protected $languageBuilder = null;

	public function __construct(LanguageBuilder $languageBuilder) {
		$this->languageBuilder = $languageBuilder;
	}

	public function buildThem($collection) {
		$dos = array();

		foreach ($collection as $item) {
			$dos[] = $this->build($item);
		}

		return $dos;
	}

	public function build(Model $entity = null) {
		$do = new DataObject();

		if ($entity) {
			$entityData = $entity->toArray();

			$entityData['language'] = $this->languageBuilder->build($entity->language);

			$do->update($entity->toArray());
		}

		return $do;
	}
}