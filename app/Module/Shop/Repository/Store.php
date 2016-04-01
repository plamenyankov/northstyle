<?php

namespace Northstyle\Module\Shop\Repository;

use Northstyle\Common\Repository as CommonRepository;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Shop\Model\Store as StoreModel;
use Northstyle\Module\Shop\DataObject\Builder\Store as StoreDOBuilder;

class Store extends CommonRepository {
	protected $model = null;

	public function __construct(StoreModel $model, StoreDOBuilder $builder) {
		$this->model = $model;
		$this->model->with(array('views', 'attribute_sets'));

		$this->setBuilder($builder);
	}

	public function findByUserId(Id $id) {
		$items = $this->model->user($id->value())->get();

		return $this->buildThem($items);
	}

	public function findOneById(Id $id) {
		$entity = $this->model->find($id->value());

		return $this->buildOne($entity);
	}

	public function findAll() {
		$items = $this->model->take(10)->get();

		return $this->buildThem($items);
	}

	public function countAll() {
		$count = $this->model->count();

		return $count;
	}
}