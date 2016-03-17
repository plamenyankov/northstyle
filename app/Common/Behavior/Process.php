<?php 

namespace Northstyle\Common\Behavior;

use Northstyle\Common\Behavior;

/**
 * A "Process" consists of several Behaviors executed in succession.
 * 
 */
class Process extends Behavior
{
	protected $name = 'process';

	protected $firstHandler = null;

	public function has($name) {
		$found = false;
		$handler = $this;

		while ($handler) {
			if ($handler->getName() == $name) {
				$found = true;
				break;
			}

			$handler = $handler->getNext();
		}

		return $found;
	}

	public function get($name) {
		$found = null;
		$handler = $this;

		while ($handler) {
			if ($handler->getName() == $name) {
				$found = $handler;
				break;
			}

			$handler = $handler->getNext();
		}

		return $found;
	}

	public function handle() {
		if ($this->hasNext()) {
			$args = func_get_args();

			$handler = $this;

			while ($handler) {
				$handler->callNext($args);

				$handler = $handler->getNext();
			}
		}
	}
}