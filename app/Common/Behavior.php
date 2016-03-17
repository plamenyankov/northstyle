<?php 

namespace Northstyle\Common;

class Behavior
{
	protected $name = 'behavior';

	protected $next = null;
	
	protected $called = false;

	public function hasNext()
	{
		if ($this->next) {
			return true;
		}
		
		return false;
	}

	public function getNext()
	{
		return $this->next;
	}

	public function setNext($next)
	{
		$this->next = $next;
	}

	public function getName() {
		return $this->name;
	}

	public function isCalled()
	{
		return $this->called;
	}

	public function callNext($args = array())
	{
		if (!$this->isCalled() && $this->hasNext()) {
			$result = call_user_func_array(array($this->next, 'handle'), $args);

			$this->called = true;
		}
	}

	public function getEventRegistry() {
		return \App::make('Northstyle.eventRegistry');
	}
}