<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 23/12/2015
 * Time: 17:38
 */

namespace MMA\Http\Controllers;

use MMA\Page;
class PageController extends Controller
{
    public function show(Page $page, array $parameters){
        return view('page',compact('page'));
    }
}