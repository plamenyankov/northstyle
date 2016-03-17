<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class Attribute extends DataObject {
	public $id = null;

	public $name = '';

	public $label = null;

	public $options = array();

	public $valuesCountLimit = 1;

	public $attributes = array();

	public $values = array();

	public $validators = array();

	public $representation = null;

	public $requiredCreate = false;

	public $requiredOrder = false;

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		}
	}

	public function set_Label($value) {
		if (is_object($value) && $value instanceof Value) {
			$this->label = $value;
		}
	}

	public function set_Attributes($value) {
		if (is_array($value)) {
			$this->options = array();

			foreach ($value as $item) {
				if (is_object($item) && $item instanceof Attribute) {
					$this->options[] = $item;
				}
			}
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

	public function set_Validators($data) {
		if (is_array($data)) {
			$this->validators = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof Validator) {
					$this->validators[] = $item;
				}
			}
		}
	}

	public function set_Representation($data) {
		if (is_object($data) && $data instanceof AttributeRepresentation) {
			$this->representation = $data;
		}
	}
}