<?php

namespace Northstyle\Module\Content\Behavior;

use Northstyle\Module\Content\Model\Page as PageModel;

use Northstyle\Module\Content\Backend\Http\Request\UpdatePageRequest;

use Northstyle\Common\Behavior as CommonBehavior;

class UpdatePage extends CommonBehavior {
	protected $repository = null;
	protected $pageModel = null;

	public function __construct(PageModel $pageModel) {
		$this->pageModel = $pageModel;
	}

	public function handle(UpdatePageRequest $request) {
		$pageEntity = $this->pageModel->find($request->page_id);

		if (!$pageEntity) {
			throw new EntityNotFoundException('Entity not found.');
		}

		$pageEntity->fill($request->only('title', 'uri', 'name','published_at','content'))->save();
	}
}