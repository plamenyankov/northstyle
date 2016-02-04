<?php
if (!function_exists('theme')) {
    function theme($path)
    {
        $config = app('config')->get('cms.theme');

        return url($config['folder'] . '/' . $config['active'] . '/assets/' . $path);
    }
}
if (!function_exists('locale')) {
    function locale($url)
    {
        return str_replace('//', '/', '/' . App::getLocale() . '/' . $url);
    }
}
if (!function_exists('lr')) {
    function lr($url)
    {

        return  '/'.App::getLocale() . $url;
    }
}
if (!function_exists('fr')) {

function fr($route)
{
    return App::getLocale() . '.' . $route;
}
}
if (!function_exists('route')) {

    function route($name, $parameters = array(), $absolute = true, $route = null)
    {
        $parameters = (array)$parameters;

        $lang = App::getLocale() . '.';

        if (in_array($name,['auth.login','auth.password.email'])) {
            $lang = '';
        }
        return app('url')->route($lang . $name, $parameters, $absolute, $route);
    }
}
