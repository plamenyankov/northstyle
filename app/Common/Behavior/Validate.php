<?php 

namespace Northstyle\Common\Behavior;

use Northstyle\Common\Behavior\_Abstract\Validate as ValidateAbstractBehavior;

class Validate extends ValidateAbstractBehavior
{
	public function handle() {
		$input = \Input::all();

		$this->validate($input);
	}
}