<?php

namespace Northstyle\Module\Core\Provider;

use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class Behavior extends IlluminateServiceProvider {
	public function register() {
	}

	public function boot() {
		$this->app->bind('core.behavior.createUser', 'Northstyle\Module\Core\Behavior\CreateUser');
		$this->app->bind('core.behavior.updateUser', 'Northstyle\Module\Core\Behavior\UpdateUser');
		$this->app->bind('core.behavior.removeUser', 'Northstyle\Module\Core\Behavior\RemoveUser');
	}
}