<?php

namespace Northstyle\Module\Shop\Repository;

use Northstyle\Common\Repository as CommonRepository;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Shop\Model\AttributeRepresentation as Model;
use Northstyle\Module\Shop\DataObject\Builder\AttributeRepresentation as DOBuilder;

class AttributeRepresentation extends CommonRepository {
	protected $model = null;

	public function __construct(Model $model, DOBuilder $builder) {
		$this->model = $model;

		$this->model->with('attributes');

		$this->setBuilder($builder);
	}

	public function findByStoreId(Id $id) {
		$items = $this->model->storeID($id->value())->get();

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