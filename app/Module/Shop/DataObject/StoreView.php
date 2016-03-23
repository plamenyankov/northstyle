<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Language;

class StoreView extends DataObject {
	public $id = null;

	public $name = '';

	public $language = null;

	public $label = '';

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}

		if (!isset($data['language'])) {
			$this->set_language(new Language());
		}
	}

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		} else {
			$this->id = Id::create($value);
		}
	}

	public function set_language($data) {
		if (is_object($data) && $data instanceof Language) {
			$this->language = $data;
		} else {
			$this->language = new Language($data);
		}
	}
}