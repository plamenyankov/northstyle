<?php

namespace Northstyle\Module\Core\DataObject;

use Northstyle\Common\DataObject;

class Language extends DataObject {

	public $id = null;

	public $label = '';

	public $code = '';

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}
	}

	public function set_id($data) {
		$this->id = Id::create($data);
	}
}