<?php

namespace Northstyle\Common;

/**
 * Represents a structure with no identity in the project
 *
 * The DataObject can easily be created out of a plain PHP array.
 * It can be passed in view templates and used in Behavior classes.
 * 
 */
class DataObject {

	/**
	 * Overload this method to add additional init logic
	 */
	protected function _init($data = array()) {
		
	}

	/**
	 * Overload this method to add additional update logic
	 */
	protected function _update($data = array()) {
		
	}

	public function __construct($data = array()) {
		$data = (array) $data;

		$this->_init($data);

		$this->update($data);
	}

	public function update($data = array()) {
		foreach ($data as $key => $value) {
			if (method_exists($this, 'set_' . $key)) {
				$m = 'set_' . $key;
				$this->$m($value);
			} else if (property_exists($this, $key)) {
				$this->{$key} = $value;
			}
		}

		$this->_update($data);
	}

	public function toArray() {
		$r = array();

		foreach ($this as $key => $value) {
			if (is_object($value) && method_exists($value, 'toArray')) {
				$r[$key] = $value->toArray();
			} else {
				$r[$key] = $value;
			}
		}

		return $r;
	}
}