<?php

namespace Northstyle\Module\Core\Repository;

use Northstyle\Common\Repository as CommonRepository;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Core\DataObject\Paginate;
use Northstyle\Module\Core\Model\Language as Model;
use Northstyle\Module\Core\DataObject\Builder\Language as DOBuilder;

class Language extends CommonRepository {
	protected $model = null;

	public function __construct(Model $model, DOBuilder $builder) {
		$this->model = $model;

		$this->setBuilder($builder);
	}

	public function findAll() {
		$items = $this->model->all();

		return $this->buildThem($items);
	}
}