<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class Product extends DataObject {
	public $id = null;

	public $user_id = null;

	public $values = array();

	public $products = array();

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

	public function set_validators($data) {
		if (is_array($data)) {
			$this->validators = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof Validator) {
					$this->validators[] = $item;
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
				}
			}
		}
	}
}