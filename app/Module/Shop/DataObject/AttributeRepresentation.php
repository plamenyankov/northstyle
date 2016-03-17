<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Value;

class AttributeRepresentation extends DataObject {
	public $type = '';

	public $defaultValue = null;

	public $settings = null;

	public function set_DefaultValue($data) {
		if (is_object($data) && $data instanceof Value) {
			$this->defaultValue = $data;
		}
	}

	public function set_Settings($data) {
		if (is_object($data) && $data instanceof AttributeRepresentationSettings) {
			$this->settings = $data;
		}
	}
}