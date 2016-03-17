<?php

namespace Northstyle\Module\Core\DataObject;

use Northstyle\Common\DataObject;

/**
 * Object ID
 *
 */
class User extends DataObject {

	public $id = null;
	public $name = '';
	public $email = '';

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}
	}

	public function set_id($data) {
		$this->id = Id::create($data);
	}
}