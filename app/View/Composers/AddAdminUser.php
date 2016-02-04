<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 19/12/2015
 * Time: 20:23
 */

namespace Northstyle\View\Composers;
use Illuminate\View\View;

class AddAdminUser
{
    public function compose(View $view){
        $view->with('admin',auth()->user());
    }
}