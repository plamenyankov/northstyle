<?php

namespace Northstyle\Module\Core\DataObject\Builder;

use Northstyle\Module\Core\Model\Language as Model;

use Northstyle\Module\Core\DataObject\Language as DataObject;

class Language {
	public function build(Model $entity = null) {
		$do = new DataObject();

		if ($entity) {
			$do->update($entity->toArray());
		}

		return $do;
	}
}