<?php


Route::controller('auth/password', 'Auth\PasswordController', [
    'getEmail' => 'auth.password.email',
    'getReset' => 'auth.password.reset'
]);
Route::controller('auth', 'Auth\AuthController', [
    'getLogin' => 'auth.login',
    'getLogout' => 'auth.logout'
]);
Route::get('backend/users/{user}/confirm',['as'=>'backend.users.confirm','uses'=>'Backend\UsersController@confirm']);
Route::resource('backend/users', 'Backend\UsersController',['except'=>'show']);
Route::get('backend/dashboard', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
Route::get('/', function () {
    return view('welcome');
});
