<?php

namespace Northstyle\Module\Core\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class ObjectValue extends DataObject {
	public $object_type = '';

	public $object_id = null;

	public $name = '';

	public $value = '';

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}

		if (!isset($data['object_id'])) {
			$this->set_object_id(0);
		}
	}

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		} else {
			$this->id = Id::create($value);
		}
	}

	public function set_object_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->object_id = $value;
		} else {
			$this->object_id = Id::create($value);
		}
	}
}