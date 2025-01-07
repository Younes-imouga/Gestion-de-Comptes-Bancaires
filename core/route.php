<?php
$router = new Router();
class Route
{
    private static $router;

    public static function setRouter($router)
    {
        self::$router = $router;
    }

    public static function get($route, $callback)
    {
        self::addRoute('GET', $route, $callback);
    }

    public static function post($route, $callback)
    {
        self::addRoute('POST', $route, $callback);
    }

    private static function addRoute($method, $route, $callback)
    {
        if (!self::$router) {
            throw new Exception('Router not set. Call Route::setRouter() first.');
        }
        self::$router->add($method, $route, $callback);
    }
}
