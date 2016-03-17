<?php

namespace Northstyle\Common;

class BehaviorRegistry {
	protected $behaviors = array();

	public function add($behaviorName, $behavior) {
		$this->behaviors[$behaviorName] = $behavior;
	}

	public function get($behaviorName) {
		return $this->behaviors[$behaviorName];
	}
}