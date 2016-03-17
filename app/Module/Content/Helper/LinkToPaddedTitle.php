<?php

namespace Northstyle\Module\Content\Helper;

class LinkToPaddedTitle
{
    public function linkToPaddedTitle($pageDO, $link) {
        $padding = str_repeat('&nbsp;', $pageDO->depth * 4);

        return $padding.link_to($link, $pageDO->title);
    }
}