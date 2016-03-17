<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Value;

class AttributeValue extends DataObject {
	public $type = null;

	public $absolute = false;

	public $value = null;

	public function set_Type($data) {
		if (is_object($data) && $data instanceof AttributeValueType) {
			$this->value = $data;
		}
	}
}