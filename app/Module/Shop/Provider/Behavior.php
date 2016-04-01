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
		$this->app->bind('shop.behavior.createStoreView', 'Northstyle\Module\Shop\Behavior\CreateStoreView');
		$this->app->bind('shop.behavior.updateStoreView', 'Northstyle\Module\Shop\Behavior\UpdateStoreView');
		$this->app->bind('shop.behavior.removeStoreView', 'Northstyle\Module\Shop\Behavior\RemoveStoreView');
		$this->app->bind('shop.behavior.createAttributeSet', 'Northstyle\Module\Shop\Behavior\CreateAttributeSet');
		$this->app->bind('shop.behavior.updateAttributeSet', 'Northstyle\Module\Shop\Behavior\UpdateAttributeSet');
		$this->app->bind('shop.behavior.removeAttributeSet', 'Northstyle\Module\Shop\Behavior\RemoveAttributeSet');
		$this->app->bind('shop.behavior.createAttribute', 'Northstyle\Module\Shop\Behavior\CreateAttribute');
		$this->app->bind('shop.behavior.updateAttribute', 'Northstyle\Module\Shop\Behavior\UpdateAttribute');
		$this->app->bind('shop.behavior.removeAttribute', 'Northstyle\Module\Shop\Behavior\RemoveAttribute');
		$this->app->bind('shop.behavior.createProduct', 'Northstyle\Module\Shop\Behavior\CreateProduct');
		$this->app->bind('shop.behavior.updateProduct', 'Northstyle\Module\Shop\Behavior\UpdateProduct');
		$this->app->bind('shop.behavior.removeProduct', 'Northstyle\Module\Shop\Behavior\RemoveProduct');
	}
}