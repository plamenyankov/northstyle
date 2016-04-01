<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class AttributeSet extends DataObject {
	public $id = null;

	public $name = '';

	public $label = '';

	public $attributes = array();

	public $values = array();

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

	public function set_attributes($value) {
		if (is_array($value)) {
			$this->attributes = array();

			foreach ($value as $item) {
				if (is_object($item) && $item instanceof Attribute) {
					$this->attributes[$item->name] = $item;
				}
			}
		}
	}

	public function set_values($data) {
		if (is_array($data)) {
			$this->values = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof ObjectValue) {
					$this->values[] = $item;
				}
			}
		}
	}
}