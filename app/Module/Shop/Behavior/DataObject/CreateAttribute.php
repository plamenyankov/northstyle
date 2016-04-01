<?php

namespace Northstyle\Module\Shop\Behavior\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Shop\DataObject\AttributeOption;

class CreateAttribute extends DataObject {
	public $name = '';

	public $label = '';

	public $options = array();

	public $values = array();

	public $attribute_set_id = null;

	public $representation_id = null;

	public $max_values_count = 1;

	public $default_value = '';

	public $required_create = false;

	public $required_order = false;

	public function _init($data = array()) {
		if (!isset($data['attribute_set_id'])) {
			$this->set_attribute_set_id(0);
		}
	}

	public function set_attribute_set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->attribute_set_id = $value;
		} else {
			$this->attribute_set_id = Id::create($value);
		}
	}

	public function set_representation_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->representation_id = $value;
		} else {
			$this->representation_id = Id::create($value);
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

	public function set_values($data) {
		if (is_array($data)) {
			$this->values = array();

			foreach ($data as $name => $value) {
				$this->values[$name] = new ObjectValue(array(
					'name' => $name,
					'value' => $value
				));
			}
		}
	}

	public function set_max_values_count($value) {
		$this->max_values_count = (int) $value;
	}

	public function set_required_create($value) {
		if ($value == 'on') {
			$this->required_create = true;
		} else {
			$this->required_create = false;
		}
	}

	public function set_required_order($value) {
		if ($value == 'on') {
			$this->required_order = true;
		} else {
			$this->required_order = false;
		}
	}
}