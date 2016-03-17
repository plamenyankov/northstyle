<?php

namespace Northstyle\Module\Shop\Behavior\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;

class CreateProduct extends DataObject {
	public $product = array();

	public function set_product($data) {
		if (is_array($data)) {
			$this->product = new Product($data);
		} else if (is_object($data) && $data instanceof Product) {
			$this->product = $data;
		}
	}
}