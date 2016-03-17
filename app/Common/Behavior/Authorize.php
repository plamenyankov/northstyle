<?php 

namespace Northstyle\Common\Behavior;

use Northstyle\Common\Behavior\_Abstract\Authorize as AuthorizeAbstractBehavior;

class Authorize extends AuthorizeAbstractBehavior
{
	public function handle() {
		$this->setArguments(func_get_args());

		$this->authorize();
	}
}