<?php

namespace Northstyle\Module\Shop\DataObject;

use Northstyle\Common\DataObject;

use Northstyle\Module\Core\DataObject\FileDO;

class PictureThumbnail extends DataObject {
	public $size = null;

	public $fileDO = null;

	public $thumbnails = array();

	public function set_File($value) {
		if (is_object($value) && $value instanceof FileDO) {
			$this->fileDO = $value;
		}
	}

	public function set_Size($value) {
		if (is_object($value) && $value instanceof PictureThumbnailSize) {
			$this->size = $value;
		}		
	}
}