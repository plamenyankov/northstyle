<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Value;

class AttributeValidator extends DataObject {
	public $type = '';

	public $settings = null;

	public function set_Settings($data) {
		if (is_object($data) && $data instanceof AttributeValidatorSettings) {
			$this->settings = $data;
		}
	}
}