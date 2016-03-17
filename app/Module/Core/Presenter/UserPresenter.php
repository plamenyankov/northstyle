<?php
/**
 * Created by PhpStorm.
 * User: vipbs
 * Date: 21/12/2015
 * Time: 21:53
 */

namespace Northstyle\Module\Core\Presenter;

use Lewis\Presenter\AbstractPresenter;

class UserPresenter extends AbstractPresenter
{
    public function lastLoginDiffrence(){
        return $this->last_login_at->diffForHumans();
    }
}