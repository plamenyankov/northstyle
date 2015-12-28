<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 20/12/2015
 * Time: 18:43
 */

namespace MMA\Templates;


use Illuminate\View\View;

class PageTemplate extends AbstractTemplate
{
    protected $view = 'page';

    public function prepare(View $view, array $parameters)
    {
//
    }
}