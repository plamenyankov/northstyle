<?php

namespace Northstyle\Module\Shop\Repository;

use Northstyle\Common\Repository as CommonRepository;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Shop\Model\Product as ProductModel;
use Northstyle\Module\Shop\DataObject\Builder\Product as ProductDOBuilder;

class Product extends CommonRepository {
	protected $model = null;

	public function __construct(ProductModel $model, ProductDOBuilder $builder) {
		$this->model = $model;

		$this->model->with('values');

		$this->setBuilder($builder);
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