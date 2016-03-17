<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\User;

class Merchant extends DataObject {
	public $id = null;

	public $user = null;

	public $stores = array();

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		}
	}

	public function set_User($value) {
		if (is_object($value) && $value instanceof User) {
			$this->user = $value;
		}
	}

	public function set_Stores($value) {
		$this->stores = array();

		if (is_array($value)) {
			foreach ($value as $item) {
				if (is_object($item) && $item instanceof Store) {
					$this->stores[] = $item;
				}
			}
		}
	}
}