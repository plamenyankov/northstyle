<?php

namespace Northstyle\Module\Content\DataObject\Builder;

use Northstyle\Module\Content\Model\Page as PageModel;

use Northstyle\Module\Content\DataObject\Page as PageDO;

class Page {
	public function build(PageModel $pageEntity = null) {
		$pageDO = new PageDO();

		if ($pageEntity) {
			$pageDO->update($pageEntity->toArray());
		}

		return $pageDO;
	}
}