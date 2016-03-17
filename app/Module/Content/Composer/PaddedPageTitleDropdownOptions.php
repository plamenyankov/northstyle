<?php

namespace Northstyle\Module\Content\Composer;

use Illuminate\Contracts\View\View;
use Northstyle\Module\Content\Repository\Page as PageRepository;
use Northstyle\Module\Content\Helper\PaddedTitle;

class PaddedPageTitleDropdownOptions {
	protected $pageRepository;

	protected $paddedTitle;

    public function __construct(PageRepository $pageRepository, PaddedTitle $paddedTitle)
    {
        $this->pageRepository = $pageRepository;
		$this->paddedTitle = $paddedTitle;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
		$orderMap = array();

		foreach ( $this->pageRepository->listAllOrdered() as $pageDO) {
			$orderMap[$pageDO->id->value()] = $this->paddedTitle->paddedTitle($pageDO, route('backend.content.page.edit', $pageDO->id->value()));
		}

        $view->with('paddedPageTitleDropdownOptions', $orderMap);
    }
}