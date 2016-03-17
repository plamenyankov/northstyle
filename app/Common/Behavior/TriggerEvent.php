<?php

namespace Northstyle\Common\Behavior;

use Northstyle\Common\DataObject;

use Northstyle\Common\Behavior\_Abstract\TriggerEvent as TriggerEventAbstractBehavior;

/**
 * Default implementation of TriggerEvent abstract behavior.
 *
 * This behavior will take all incoming arguments and attempt to convert them into 
 * event parameters. Only objects with a "toArray" method are converted.
 *
 * The trigger event name must be provided before-hand ($this->setEventName()).
 *
 */
class TriggerEvent extends TriggerEventAbstractBehavior {
	public function handle() {
		$eventParams = array();

		foreach (func_get_args() as $arg) {
			if (is_object($arg) && method_exists($arg, 'toArray')) {
				$className = lcfirst(get_class($arg));

				if ($arg instanceof DataOjbect) {
					$className .= 'DO';
				}

				$eventParams[$className] = $arg;
			}
		}

		$this->getEventRegistry()->addEvent($this->getEventName(), $eventParams);
	}
}