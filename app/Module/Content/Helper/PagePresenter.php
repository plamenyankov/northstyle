<?php

namespace Northstyle\Module\Content\Presenter;

class PagePresenter
{
    public function contentHtml() {
        return $this->markdown->convertToHtml($pageDO->content);
    }

    public function prettyUri(){
        return '/'.ltrim($pageDO->uri,'/');
    }

    public function uriWildcard() {
        return $pageDO->uri.'*';
    }
}