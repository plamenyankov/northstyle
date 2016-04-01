<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\ObjectValue;

class Product extends DataObject {
	public $id = null;

	public $user_id = null;

	public $attribute_set = array();

	public $products = array();

	public $attributes = array();

	public $values = array();

	public $values_tree = array();

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}

		if (!isset($data['user_id'])) {
			$this->set_user_id(0);
		}
	}

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		} else {
			$this->id = Id::create($value);
		}
	}

	public function set_user_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->user_id = $value;
		} else {
			$this->user_id = Id::create($value);
		}
	}

	public function set_attribute_set($data) {
		if (is_object($data) && $data instanceof AttributeSet) {
			$this->attribute_set = $data;
		} else if (is_array($data)) {
			$this->attribute_set = new AttributeSet($data);
		}
	}

	public function set_attributes($data) {
		if (is_array($data)) {
			$this->attributes = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof Attribute) {
					$this->attributes[] = $item;
				} else if (is_array($item)) {
					$this->attributes[] = new Attribute($item);
				}
			}
		}
	}

	public function set_products($data) {
		if (is_array($data)) {
			$this->products = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof Product) {
					$this->products[] = $item;
				} else if (is_array($item)) {
					$this->products[] = new Product($item);
				}
			}
		}
	}

	public function set_values($data) {
		if (is_array($data)) {
			$this->values = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof ObjectValue) {
					$this->values[$item->name] = $item;
				} else if (is_array($item)) {
					$this->values[$item['name']] = new ObjectValue($item);
				}
			}
		}

		$this->set_values_tree($this->values);
	}

	public function set_values_tree($data) {
		if (!is_array($data)) {
			return;
		}

		$this->values_tree = array();

		foreach ($data as $item) {
			if (is_object($item) && $item instanceof ObjectValue) {
				$name = $item->name;
			} else if (is_array($item)) {
				$name = $item['name'];
			}

			$keys = explode('.', $name);

			$ptr = & $this->values_tree;
			$pptr = & $ptr;

			foreach ($keys as $key) {
				if (!isset($ptr[$key])) {
					$ptr[$key] = array('values' => array(), 'value' => array());
				}

				$pptr = & $ptr[$key];
				$ptr = & $ptr[$key]['values'];
			}

			if (is_object($item) && $item instanceof ObjectValue) {
				$pptr['value'] = $item;
			} else if (is_array($item)) {
				$pptr['value'] = new ObjectValue($item);
			}
		}
	}
}