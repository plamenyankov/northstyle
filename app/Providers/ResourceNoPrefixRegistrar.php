<?php

namespace Northstyle\Providers;

use Illuminate\Routing\ResourceRegistrar;
use Illuminate\Routing\Router;

class ResourceNoPrefixRegistrar extends ResourceRegistrar
{
    protected $resourceDefaults = ['index', 'create', 'store', 'show', 'edit', 'update', 'confirm_delete', 'destroy'];

    public function __construct(Router $router)
    {
        parent::__construct($router);
    }

    /**
     * Get the resource name for a grouped resource.
     *
     * @param  string  $prefix
     * @param  string  $resource
     * @param  string  $method
     * @return string
     */
    protected function getGroupResourceName($prefix, $resource, $method)
    {
        // vsch: don't add prefix to the route name, if you want a prefix added to the route name add 'as' => 'prefix.' to the group options
        return trim("{$prefix}{$resource}.{$method}", '.');
    }

	
	public function getResourceWildcard($value) {
		return $value . '_id';
	}

    /**
     * Add the confirm_delete method for a resourceful route.
     *
     * @param  string  $name
     * @param  string  $base
     * @param  string  $controller
     * @param  array   $options
     * @return \Illuminate\Routing\Route
     */
    protected function addResourceConfirm_delete($name, $base, $controller, $options)
    {
        $uri = $this->getResourceUri($name).'/{'.$base.'}/confirm_delete';

        $action = $this->getResourceAction($name, $controller, 'confirm_delete', $options);

        return $this->router->get($uri, $action);
    }
}