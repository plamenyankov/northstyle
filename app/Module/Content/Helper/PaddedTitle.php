<?php

namespace Northstyle\Module\Content\Helper;

class PaddedTitle
{
    public function paddedTitle($pageDO) {
        return str_repeat('&nbsp;',$pageDO->depth * 4) . $pageDO->title;
    }
}