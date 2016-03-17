<?php

namespace Northstyle\Module\Content\DataObject;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Common\DataObject;

class Page extends DataObject {
	public $id = null;
	public $title = '';
	public $name = '';
	public $uri = '';
	public $pretty_uri = '';
	public $content = '';
	public $template = '';
	public $depth = 0;
	public $lft = 0;
	public $rgt = 0;
	public $hidden = false;
	public $created_at = null;
	public $updated_at = null;
	public $published_at = null;

	public function _init($data = array()) {
		if (!isset($data['id'])) {
			$this->set_id(0);
		}
	}

	public function set_id($data) {
		$this->id = Id::create($data);
	}
}