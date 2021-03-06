<?php

namespace Northstyle\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Northstyle\Module\Content\Model\Page;

use Northstyle\Module\Core\DataObject\Id;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Northstyle';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        parent::boot($router);

		$router->bind('id', function($value) {
			$id = Id::create($value);

			return $id;
		});

		$router->bind('page_id', function($value) {
			$id = Id::create($value);

			return $id;
		});

		$router->bind('store_id', function($value) {
			$id = Id::create($value);

			return $id;
		});

		$router->bind('store_view_id', function($value) {
			$id = Id::create($value);

			return $id;
		});

		$router->bind('user_id', function($value) {
			$id = Id::create($value);

			return $id;
		});

		$router->bind('product_id', function($value) {
			$id = Id::create($value);

			return $id;
		});

		$router->bind('attribute_set_id', function($value) {
			$id = Id::create($value);

			return $id;
		});

		$router->bind('attribute_id', function($value) {
			$id = Id::create($value);

			return $id;
		});
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function map(Router $router, Request $request)
    {
        $locale = $request->segment(1);

		if ($locale == 'localhost') {
			$locale = 'bg';
		}

        $this->app->setLocale($locale);
 
        $router->group(['namespace' => $this->namespace, 'prefix' => $locale, 'as' => $locale . '.', 'middleware' => 'language'], function ($router) {
            require app_path('Http/routes.php');

			$router->group(['prefix' => 'api/v1', 'as' => 'api.', 'middleware' => 'auth'], function ($router) {
				$router->group(['namespace' => 'Module\Shop\APIv1\Http\Controller'], function ($router) {
					\Route::resource('attribute', 'AttributeController');
				});
			});
        });
	}

}
