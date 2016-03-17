<?php

namespace Northstyle\Module\Shop\DataObject\AttributeValidatorSettings;

use Northstyle\Module\Shop\DataObject\AttributeValidatorSettings;
 
class ValueRange extends AttributeValidatorSettings {
	public $minValue = 0;

	public $maxValue = 0;

	public $strict = false;

	public function set_MinValue($data) {
		if (!is_int($data)) {
			return;
		}

		$this->minValue = $data;
	}

	public function set_MaxValue($data) {
		if (!is_int($data)) {
			return;
		}

		$this->maxValue = $data;
	}

	public function set_Strict($data) {
		if (!is_bool($data)) {
			return;
		}

		$this->strict = $data;
	}
}