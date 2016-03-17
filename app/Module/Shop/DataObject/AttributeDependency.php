<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Value;

class AttributeDependency extends DataObject {
	public $id = null;

	public $name = '';

	public $values = array();

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		}
	}

	public function set_values($data) {
		if (is_array($data)) {
			$this->values = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof Value) {
					$this->values[] = $item;
				}
			}
		}
	}
}