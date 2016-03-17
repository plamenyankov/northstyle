<?php

namespace Northstyle\Module\Core\DataObject;

use Northstyle\Common\DataObject;

/**
 * Object ID
 *
 */
class Id extends DataObject {
	public $value = 0;

	public function set_value($value) {
		if (is_numeric($value)) {
			$this->value = (int) $value;
		}
	}

	public function value() {
		return $this->value;
	}

	public function __toString()
	{
		return strval($this->value);
	}

	public function toArray() {
		return $this->value;
	}

	static public function create($value) {
		$id = new self(array('value' => $value));

		return $id;
	}
}