<?php

namespace Northstyle\Module\Shop\Behavior\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\ObjectValue;

use Northstyle\Module\Shop\DataObject\Product;

class CreateProduct extends DataObject {
	public $store_id = null;

	public $attribute_set_id = null;

	public $values = array();

	public function set_store_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->store_id = $value;
		} else {
			$this->store_id = Id::create($value);
		}
	}

	public function set_attribute_set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->attribute_set_id = $value;
		} else {
			$this->attribute_set_id = Id::create($value);
		}
	}

	public function set_values($data) {
		if (is_array($data)) {
			$this->values = array();

			foreach ($data as $name => $value) {
				$this->values[$name] = new ObjectValue(array(
					'name' => $name,
					'value' => $value
				));
			}
		}
	}
}