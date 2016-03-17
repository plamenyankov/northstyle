<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

class Money extends DataObject {
	public $value = '';
	public $currency = null;

	public function set_Currency($value) {
		if (is_object($value) && $value instanceof Currency) {
			$this->currency = $value;
		}
	}
}