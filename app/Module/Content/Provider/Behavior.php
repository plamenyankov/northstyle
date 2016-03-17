<?php

namespace Northstyle\Module\Content\Provider;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class Behavior extends IlluminateServiceProvider {
	public function register() {
	}

	public function boot() {
		$this->app->bind('content.behavior.createPage', 'Northstyle\Module\Content\Behavior\CreatePage');
		$this->app->bind('content.behavior.updatePage', 'Northstyle\Module\Content\Behavior\UpdatePage');
		$this->app->bind('content.behavior.removePage', 'Northstyle\Module\Content\Behavior\RemovePage');
	}
}