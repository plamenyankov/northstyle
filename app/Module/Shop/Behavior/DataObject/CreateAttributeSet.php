<?php

namespace Northstyle\Module\Shop\Behavior\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class CreateAttributeSet extends DataObject {
	public $name = '';

	public $label = '';

	public $store_id = null;

	public function _init($data = array()) {
		if (!isset($data['store_id'])) {
			$this->set_store_id(0);
		}
	}

	public function set_store_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->store_id = $value;
		} else {
			$this->store_id = Id::create($value);
		}
	}
}