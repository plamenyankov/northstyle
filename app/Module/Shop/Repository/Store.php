<?php

namespace Northstyle\Module\Shop\Repository;

use Northstyle\Common\Repository as CommonRepository;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Shop\Model\Store as StoreModel;

class Store extends CommonRepository {
	protected $model = null;

	public function __construct(StoreModel $model) {
		$this->model = $model;
	}

	public function findOneById(Id $id) {
		$entity = $this->model->find($id->value());

		return $entity;
	}

	public function findAll() {
		$items = $this->model->take(10)->get();

		return $items;
	}

	public function countAll() {
		$count = $this->model->count();

		return $count;
	}
}