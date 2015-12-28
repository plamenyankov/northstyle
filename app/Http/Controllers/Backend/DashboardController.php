<?php

namespace MMA\Http\Controllers\Backend;
use MMA\Post;
use MMA\User;
class DashboardController extends Controller{
    public function index(Post $post, User $user){
        $posts = $post->orderBy('updated_at','desc')->take(5)->get();
        $users = $user->whereNotNull('last_login_at')->orderBy('last_login_at','desc')->take(5)->get();
        return view('backend.dashboard',compact('posts','users'));
    }
}