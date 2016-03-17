<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 23/12/2015
 * Time: 09:49
 */

namespace Northstyle\View\Composers;

use Illuminate\View\View;
use Northstyle\Module\Content\Model\Page;

class InjectPages
{
    protected $pages;

    /**
     * InjectPages constructor.
     */
    public function __construct(Page $page)
    {
        $this->pages = $page;
    }

    public function compose(View $view){
        $pages = $this->pages->all()->toHierarchy();

        $view->with('pages',$pages);
    }
}