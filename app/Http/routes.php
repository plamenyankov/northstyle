<?php


Route::controller('auth/password', 'Auth\PasswordController', [
    'getEmail' => 'auth.password.email',
    'getReset' => 'auth.password.reset'
]);

Route::controller('auth', 'Auth\AuthController', [
    'getLogin' => 'auth.login',
    'getLogout' => 'auth.logout'
]);
Route::get('getLogin','Auth\AuthController@login');
Route::get('backend/users/{user}/confirm','Backend\UsersController@confirm');
Route::resource('backend/users', 'Backend\UsersController',['except'=>'show']);
Route::get('backend/pages/{pages}/confirm',['as'=>'backend.pages.confirm','uses'=>'Backend\PagesController@confirm']);
Route::resource('backend/pages', 'Backend\PagesController');
Route::get('backend/category/{category}/confirm',['as'=>'backend.category.confirm','uses'=>'Backend\CategoryController@confirm']);
Route::resource('backend/category', 'Backend\CategoryController');
Route::get('backend/blog/{blog}/confirm',['as'=>'backend.blog.confirm','uses'=>'Backend\BlogController@confirm']);
Route::resource('backend/blog', 'Backend\BlogController');
Route::get('backend/sofa/{id}/confirm',['as'=>'backend.sofa.confirm','uses'=>'Backend\SofasController@confirm']);
Route::resource('backend/sofa', 'Backend\SofasController');
Route::get('backend/article/{blog}/confirm',['as'=>'backend.blog.confirm','uses'=>'Backend\BlogController@confirm']);
Route::resource('backend/articles', 'Backend\ArticleController');
Route::get('backend/dashboard', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
Route::get('/', function () {
    return view('welcome');
});
