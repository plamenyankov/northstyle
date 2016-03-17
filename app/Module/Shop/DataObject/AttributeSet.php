<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class AttributeSet extends DataObject {
	public $id = null;

	public $name = '';

	public $label = null;

	public $attributes = array();

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		}
	}

	public function set_Label($value) {
		if (is_object($value) && $value instanceof Value) {
			$this->label = $value;
		}
	}

	public function set_Attributes($value) {
		if (is_array($value)) {
			$this->attributes = array();

			foreach ($value as $item) {
				if (is_object($item) && $item instanceof Attribute) {
					$this->attributes[] = $item;
				}
			}
		}
	}
}