<?php

namespace Northstyle\Module\Core\DataObject;

use Northstyle\Common\DataObject;

/**
 * Object ID
 *
 */
class APIResponse extends DataObject {

	public $total = 0;
	public $per_page = 0;
	public $current_page = 0;
	public $last_page = 0;
	public $next_page_url = '';
	public $prev_page_url = '';
	public $from = 0;
	public $to = 0;
	public $items = array();
}