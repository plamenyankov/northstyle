<?php

namespace Northstyle\Providers;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class AppServiceProvider extends IlluminateServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function ()
        {
            return \App::make('Northstyle\Providers\ResourceNoPrefixRegistrar');
        });
    }
}
