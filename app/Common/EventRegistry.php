<?php

namespace Northstyle\Common;

class EventRegistry
{
	protected $context = null;

	protected $lastEvent = null;

	protected $eventsMap = array();

	protected $events = array();

	public function __construct(Context $context)
	{
		$this->context = $context;
	}

	public function getContext()
	{
		return $this->context;
	}

	public function getLastEvent() {
		if (!count($this->events)) {
			return array();
		}

		return array_slice($this->events, -1)[0];
	}

	public function eventClassName($eventName) {
		$parts = explode('.', $eventName);

		$className = '';

		foreach ($parts as $part) {
			$className .= "\\" . ucfirst($part);
		}

		$className = rtrim($className, "\\");

		return $className;
	}

	public function createEvent($eventName, $eventParams = array()) {

		$className = $this->eventClassName($eventName);

		$event = new $className($eventParams);

		$this->addEvent($event);
	}

	public function addEvent($event) {
		$this->events[] = $event;
	}

	public function get($eventName) {
		$event = null;
		$rev = array_reverse($this->events);

		foreach ($rev as $_event) {
			if ($_event->eventName == $eventName) {
				$event = $_event;
			}
		}

		return $event;
	}

	public function processAddedEvents() {
		foreach ($this->events as $event) {
			$this->processAddedEvent($event);
		}
	}

	public function processAddedEvent(Event $event)
	{
		$logEvent = new \SystemEvent();
		$logEvent->user_id = 0;

		if (\Auth::check()) {
			$logEvent->user_id = \Auth::user()->id;
		}

		if (property_exists($event, 'eventName')) {
			$logEvent->event_name = $event->eventName;
		} else {
			$logEvent->event_name = get_class($event);
		}

		$logEvent->event_data = $event;

		if (isset($_SERVER['REMOTE_ADDR'])) {
			$logEvent->client_ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$logEvent->client_ip = '::1';
		}

		if ($this->getContext()->hasSourceEvent()) {
			$sourceSystemEvent = $this->getContext()->getSourceEvent();

			$logEvent->sourceEvent()->associate($sourceSystemEvent);
		}

		$logEvent->source = 'front';

		if (\Request::is('cms*')) {
			$logEvent->source = 'cms';
		} else if (\Request::is('api')) {
			$logEvent->source = 'api';
		}

		$logEvent->save();

		$this->getContext()->setSourceEvent($logEvent);
	}
}