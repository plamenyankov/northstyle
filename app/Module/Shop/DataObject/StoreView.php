<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class StoreView extends DataObject {
	public $id = null;

	public $name = '';

	public $label = '';

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		}
	}
}