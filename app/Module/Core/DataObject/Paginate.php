<?php

namespace Northstyle\Module\Core\DataObject;

use Northstyle\Common\DataObject;

/**
 * Object ID
 *
 */
class Paginate extends DataObject {

	public $total = 0;
	public $per_page = 0;
	public $current_page = 0;
	public $last_page = 0;
	public $from = 0;
	public $to = 0;
	public $items = array();
}