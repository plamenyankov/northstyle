<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Value;

class AttributeRepresentation extends DataObject {
	public $id = null;

	public $name = '';

	public $class = '';

	public $defaultValue = null;

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

	public function set_defaultValue($data) {
		if (is_object($data) && $data instanceof Value) {
			$this->defaultValue = $data;
		}
	}
}