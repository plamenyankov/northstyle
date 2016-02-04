<?php
namespace Northstyle\Listeners;

use Carbon\Carbon;

class UpdateLastLoginOnLogin
{

    public function handle($user, $handle)
    {
        $user->last_login_at = Carbon::now();
        $user->save();
    }
}