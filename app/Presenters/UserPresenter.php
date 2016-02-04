<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 21/12/2015
 * Time: 21:53
 */

namespace Northstyle\Presenters;

use Lewis\Presenter\AbstractPresenter;

class UserPresenter extends AbstractPresenter
{
    public function lastLoginDiffrence(){
        return $this->last_login_at->diffForHumans();
    }
}