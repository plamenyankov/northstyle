<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 23/12/2015
 * Time: 09:49
 */

namespace MMA\View\Composers;

use Illuminate\View\View;
use MMA\Page;

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
//        dd($pages);
        $view->with('pages',$pages);
    }
}