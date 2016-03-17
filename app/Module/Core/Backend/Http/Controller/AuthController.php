<?php

namespace Northstyle\Module\Core\Backend\Http\Controller;

use Northstyle\Module\Core\Model\User;

use Northstyle\Http\Controllers\Controller;

use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

//    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    use AuthenticatesUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->redirectAfterLogout = lr('/auth/login');
        $this->redirectTo = lr('/backend/dashboard');
        $this->middleware('guest', ['except' => 'getLogout']);
    }
}
