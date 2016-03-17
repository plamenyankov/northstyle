<?php

namespace Northstyle\Common;

class Repository {
	protected $builder;

	public function getBuilder() {
		return $this->builder;
	}

	public function setBuilder($builder) {
		$this->builder = $builder;
	}

	public function buildOne($entity) {
		return $this->getBuilder()->build($entity);
	}

	public function buildThem($collection) {
		$list = array();

		foreach ($collection as $item) {
			$list[] = $this->buildOne($item);
		}

		return $list;
	}
}