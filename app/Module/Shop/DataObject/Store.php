<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class Store extends DataObject {
	public $id = null;

	public $label = '';

	public $views = array();

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

	public function set_views($value) {
		if (is_array($value)) {
			$this->views = array();

			foreach ($value as $item) {
				if (is_object($item) && $item instanceof StoreView) {
					$this->views[] = $item;
				}
			}
		}
	}
}