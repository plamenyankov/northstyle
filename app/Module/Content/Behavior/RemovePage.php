<?php

namespace Northstyle\Module\Content\Behavior;

use Northstyle\Module\Core\DataObject\Id;

use Northstyle\Module\Content\Model\Page as PageModel;
use Northstyle\Module\Content\Repository\Page as PageRepository;

use Northstyle\Module\Content\Backend\Http\Request\RemovePageRequest;

use Northstyle\Common\Behavior as CommonBehavior;

class RemovePage extends CommonBehavior {
	protected $pageModel = null;

	public function __construct(PageModel $pageModel) {
		$this->pageModel = $pageModel;
	}

	public function handle(RemovePageRequest $request) {
		$pageEntity = $this->pageModel->find($request->page_id);

		if (!$pageEntity) {
			throw new EntityNotFoundException('Entity not found.');
		}

		$pageEntity->delete();
	}
}