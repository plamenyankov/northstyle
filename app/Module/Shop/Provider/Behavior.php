<?php

namespace Northstyle\Module\Shop\Provider;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class Behavior extends IlluminateServiceProvider {
	public function register() {
	}

	public function boot() {
		$this->app->bind('shop.behavior.createStore', 'Northstyle\Module\Shop\Behavior\CreateStore');
		$this->app->bind('shop.behavior.updateStore', 'Northstyle\Module\Shop\Behavior\UpdateStore');
		$this->app->bind('shop.behavior.removeStore', 'Northstyle\Module\Shop\Behavior\RemoveStore');
	}
}