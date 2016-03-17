<?php

namespace Northstyle\Module\Core\DataObject;

use Northstyle\Common\DataObject;

class Filepath extends DataObject {
	public $filepath = '';

	public function set_filepath($filepath) {
		if (empty($filepath)) {
			return;
		}

		$this->filepath = $filepath;
		$this->filepath = str_replace('/', DIRECTORY_SEPARATOR, $this->filepath);
		$this->filepath = str_replace("\\", DIRECTORY_SEPARATOR, $this->filepath);
	}

	public function full() {
		return $this->filepath;
	}

	public function path() {		
		$separatorPos = strrpos($this->filepath, DIRECTORY_SEPARATOR);

		if ($separatorPos !== false) {
			$pathOnly = substr($this->filepath, 0, $separatorPos);
		} else {
			// there is no separation, we assume it's only a filename
			$pathOnly = '';
		}

		return $pathOnly;
	}

	public function nameNoExt() {
		$name = $this->name();

		$extPos = strpos($name, '.');

		if ($extPos !== false) {
			$nameNoExt = substr($name, 0, $extPos);
		} else {
			$nameNoExt = $name;
		}

		return $nameNoExt;
	}

	public function ext() {
		$name = $this->name();

		$nameParts = explode('.', $name);

		if (count($nameParts)) {
			return $nameParts[count($nameParts)-1];
		} else {
			return '';
		}
	}

	public function name() {
		$pathParts = explode(DIRECTORY_SEPARATOR, $this->filepath);

		if (count($pathParts)) {
			return $pathParts[count($pathParts)-1];
		} else {
			return $this->filepath;
		}
	}

	public function append($path) {
		$pathDO = new self(array('filepath' => $path));
		$newDO = new self(array('filepath' => $this->path() . DIRECTORY_SEPARATOR . $pathDO->name()));

		return $newDO;
	}

	public function __toString() {
		return $this->filepath;
	}
}