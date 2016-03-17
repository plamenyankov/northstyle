<?php

$router->group(['prefix' => 'api/v1', 'as' => 'api.v1.'], function ($router) {
	// Route::resource('products', 'API\v1\ProductsController');
});

$router->group(['prefix' => 'backend', 'as' => 'backend.'], function ($router) {

	Route::resource('dashboard', 'Http\Controllers\Backend\DashboardController');

	$router->group(['namespace' => 'Module\Core\Backend\Http\Controller', 'prefix' => 'core', 'as' => 'core.'], function ($router) {
		Route::get('/', ['as' => 'index', 'uses' => 'IndexController@index']);

		Route::controller('auth/password', 'PasswordController', [
			'getEmail' => 'auth.password.email',
			'getReset' => 'auth.password.reset'
		]);

		Route::controller('auth', 'AuthController', [
			'getLogin' => 'auth.login',
			'getLogout' => 'auth.logout'
		]);

		Route::get('getLogin','AuthController@login');

		Route::resource('user', 'UserController');

		Route::get('core/user/{user}/confirm', 'UserController@confirm');
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
		Route::resource('store.product', 'StoreProductController');
		Route::resource('store.attribute_set', 'StoreProductAttributeSetController');
		Route::resource('store.attribute', 'StoreProductAttributeController');
	});
});

Route::get('/', function () {
    return view('welcome');
});
