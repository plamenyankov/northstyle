<?php

namespace Northstyle\Http\Controllers\Backend;

use Northstyle\Module\Shop\Model\User as UserModel;

use Northstyle\Module\Content\Model\Post as PostModel;

class DashboardController extends Controller {
    public function index(PostModel $post, UserModel $user) {
        $posts = $post->orderBy('updated_at','desc')->take(5)->get();
        $users = $user->whereNotNull('last_login_at')->orderBy('last_login_at','desc')->take(5)->get();

        return view('backend.dashboard',compact('posts','users'));
    }

	public function setStore() {
		$storeID = (int) \Input::get('current_store');

		\Session::put('currentStoreID', $storeID);

		return \Redirect::to(route('backend.dashboard.index'));
	}

	public function setStoreView() {
		return \Redirect::route();
	}
}