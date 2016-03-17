<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\FileDO;

class Picture extends DataObject {
	public $id = null;

	public $original = null;

	public $thumbnails = null;

	public function set_id($value) {
		if (is_object($value) && $value instanceof Id) {
			$this->id = $value;
		}
	}

	public function set_Original($value) {
		if (is_object($value) && $value instanceof FileDO) {
			$this->original = $value;
		}
	}

	public function set_Thumbnails($value) {
		$this->thumbnails = array();

		if (is_array($value)) {
			foreach ($value as $item) {
				if (is_object($item) && $item instanceof PictureThumbnail) {
					$this->thumbnails[] = $item;
				}
			}
		}
	}
}