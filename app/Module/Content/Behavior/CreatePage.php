<?php

namespace Northstyle\Module\Content\Behavior;

use Northstyle\Module\Content\Model\Page as PageModel;

use Northstyle\Module\Content\Backend\Http\Request\StorePageRequest;

use Northstyle\Common\Behavior as CommonBehavior;

class CreatePage extends CommonBehavior {
	protected $pageModel = null;

	public function __construct(PageModel $pageModel) {
		$this->pageModel = $pageModel;
	}

	public function handle(StorePageRequest $request) {
        $this->pageModel->create($request->only('title','uri','content'));
	}
}