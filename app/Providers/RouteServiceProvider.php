<?php

namespace Northstyle\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;
use Northstyle\Page;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to the controller routes in your routes file.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Northstyle\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        //

        parent::boot($router);
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
        $this->app->setLocale($locale);
//dd($locale);
        $router->group(['namespace' => $this->namespace, 'prefix' => $locale], function ($router) {
            require app_path('Http/routes.php');
        });

//            foreach (Page::all() as $page) {
//                $router->get($locale . '/' . $page->uri, ['as' => $page->name, function () use ($page, $router) {
//                    return $this->app->call('Northstyle\Http\Controllers\PageController@show', [
//                        'page' => $page,
//                        'parameters' => $router->current()->parameters()
//                    ]);
//                }]);
//            }
        }

}
