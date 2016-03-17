<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Value;

class AttributeOption extends DataObject {
	public $id = null;

	public $label = null;

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
}