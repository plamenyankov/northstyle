<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 23/12/2015
 * Time: 17:38
 */

namespace Northstyle\Http\Controllers;

use Northstyle\Page;
class PageController extends Controller
{
    public function show(Page $page, array $parameters){
        return view('page',compact('page'));
    }
}