<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class Attribute extends DataObject {
	public $id = null;

	public $representation_id = null;

	public $representation = array();

	public $edit_url = '';

	public $name = '';

	public $label = null;

	public $options = array();

	public $values = array();

	public $validators = array();

	public $max_values_count = 1;

	public $default_value = '';

	public $required_create = false;

	public $required_order = false;

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}

		if (!isset($data['representation_id'])) {
			$this->set_representation_id(0);
		}
	}

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		} else {
			$this->id = Id::create($value);
		}
	}

	public function set_representation_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->representation_id = $value;
		} else {
			$this->representation_id = Id::create($value);
		}
	}

	public function set_label($value) {
		$this->label = $value;
	}

	public function set_attributes($value) {
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
				if (is_object($item) && $item instanceof ObjectValue) {
					$this->values[$item->name] = $item;
				} else if (is_array($item)) {
					$this->values[$item['name']] = new ObjectValue($item);
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

	public function set_representation($data) {
		if (is_object($data) && $data instanceof AttributeRepresentation) {
			$this->representation = $data;
		} else if (is_array($data)) {
			$this->representation = new AttributeRepresentation($data);
		}
	}

	public function set_options($data) {
		if (is_array($data)) {
			$this->options = array();

			foreach ($data as $item) {
				if (is_object($item) && $item instanceof AttributeOption) {
					$this->options[] = $item;
				} else if (is_array($item)) {
					$this->options[] = new AttributeOption($item);
				}
			}
		}
	}
}