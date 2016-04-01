<?php

$router->group(['prefix' => 'backend', 'as' => 'backend.', 'middleware' => 'auth'], function ($router) {

	$router->group(['prefix' => 'dashboard', 'as' => 'dashboard.'], function($router) {
		Route::get('/', ['as' => 'index', 'uses' => 'Http\Controllers\Backend\DashboardController@index']);
		Route::get('/set_store', ['as' => 'set_store', 'uses' => 'Http\Controllers\Backend\DashboardController@setStore']);
		Route::get('/set_store_view', ['as' => 'set_store_view', 'uses' => 'Http\Controllers\Backend\DashboardController@setStoreView']);
	});

	Route::controller('auth/password', 'Module\Core\Backend\Http\Controller\PasswordController', [
		'getEmail' => 'auth.password.email',
		'getReset' => 'auth.password.reset'
	]);

	Route::controller('auth', 'Module\Core\Backend\Http\Controller\AuthController', [
		'getLogin' => 'auth.login',
		'postLogin' => 'auth.login.post',
		'getLogout' => 'auth.logout'
	]);

	$router->group(['namespace' => 'Module\Core\Backend\Http\Controller', 'prefix' => 'core', 'as' => 'core.'], function ($router) {
		Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

		Route::resource('user', 'UserController');

		Route::get('user/{user}/confirm', 'UserController@confirm');
	});

	$router->group(['namespace' => 'Module\Content\Backend\Http\Controller', 'prefix' => 'content', 'as' => 'content.'], function ($router) {
		Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

		Route::get('page/{id}/confirm_delete', ['as' => 'page.confirm_delete', 'uses' => 'PageController@confirm_delete']);

		Route::resource('article', 'ArticleController');
		Route::resource('page', 'PageController');
		Route::resource('blog_post', 'BlogPostController');
		Route::resource('article_category', 'ArticleCategoryController');
	});

	$router->group(['namespace' => 'Module\Shop\Backend\Http\Controller', 'prefix' => 'shop', 'as' => 'shop.'], function ($router) {
		Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

		Route::resource('store', 'StoreController');
		Route::resource('store.store_view', 'StoreViewController');
		Route::resource('store.product', 'StoreProductController');
		Route::resource('store.attribute_set', 'StoreAttributeSetController');
		Route::resource('store.attribute_set.attribute', 'StoreAttributeSetAttributeController');
	});
});

Route::get('/', function () {
    return view('welcome');
});
