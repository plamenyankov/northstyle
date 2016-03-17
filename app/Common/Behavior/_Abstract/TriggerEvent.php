<?php

namespace Northstyle\Common\Behavior\_Abstract;

use Northstyle\Common\Behavior;

use Northstyle\Common\EventRegistry;

abstract class TriggerEvent extends Behavior {
	protected $eventRegistry = null;

	protected $name = 'triggerEvent';

	protected $eventName = 'Northstyle.event.dummy';

	protected $eventParams = array();

	public function __construct(EventRegistry $eventRegistry) {
		$this->eventRegistry = $eventRegistry;
	}

	public function getEventRegistry() {
		return $this->eventRegistry;
	}

	public function getLastEvent() {
		return $this->eventRegistry->getLastEvent();
	}

	public function setEventParams($params = array()) {
		$this->eventParams = $params;
	}

	public function getEventParams() {
		return $this->eventParams;
	}

	public function setEventName($name) {
		$this->eventName = $name;
	}

	public function getEventName() {
		return $this->eventName;
	}
}