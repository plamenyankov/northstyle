<?php

namespace Northstyle\Module\Core\Repository;

use Northstyle\Common\Repository as CommonRepository;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Paginate;
use Northstyle\Module\Core\Model\User as UserModel;
use Northstyle\Module\Core\DataObject\Builder\User as UserDOBuilder;

class User extends CommonRepository {
	protected $model = null;

	public function __construct(UserModel $model, UserDOBuilder $builder) {
		$this->model = $model;

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