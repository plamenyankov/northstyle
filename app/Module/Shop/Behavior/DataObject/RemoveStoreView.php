<?php

namespace Northstyle\Module\Shop\Behavior\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class RemoveStoreView extends DataObject {
	public $id = null;

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}
	}

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		} else {
			$this->id = Id::create($value);
		}
	}
}