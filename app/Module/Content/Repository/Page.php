<?php

namespace Northstyle\Module\Content\Repository;

use Northstyle\Common\Repository as CommonRepository;

use Northstyle\Module\Core\DataObject\Id;
use Northstyle\Module\Content\Model\Page as PageModel;
use Northstyle\Module\Content\DataObject\Builder\Page as PageDOBuilder;

class Page extends CommonRepository implements PageInterface {
	protected $pageModel = null;

	public function __construct(PageModel $pageModel, PageDOBuilder $builder) {
		$this->pageModel = $pageModel;

		$this->setBuilder($builder);
	}

	public function listAllOrdered() {
		$pages = $this->pageModel->visible()->orderBy('lft', 'asc')->get();

		return $this->buildThem($pages);
	}

	public function findOneById(Id $id) {
		$entity = $this->pageModel->find($id->value());

		return $this->buildOne($entity);
	}

	public function listAll() {
		$pages = $this->pageModel->publishedDesc()->paginate(10);

		return $this->buildThem($pages);
	}
}