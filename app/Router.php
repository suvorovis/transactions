<?php

namespace transactions;

class Router
{
    private static $routes = [];
    
    /**
     * @param Request $request
     *
     * @return Route
     */
    public function getRoute(Request $request): Route
    {
        if (!isset(self::$routes[$request->getPath()])) {
            throw new \RuntimeException("Wrong route '{$request->getPath()}'");
        }
        
        /** @var Route $route */
        $route = self::$routes[$request->getPath()];
        
        if ($request->getType() !== $route->getType()) {
            throw new \RuntimeException("Wrong route '{$request->getPath()}' type '{$request->getType()}'");
        }
        
        return $route;
    }
    
    public static function redirect(string $uri): void
    {
        header("Location: /{$uri}");
        die();
    }
    
    public static function get(
        string $route,
        string $controller,
        string $method,
        array $roles = []
    ): void {
        self::register('get', $route, $controller, $method, $roles);
    }
    
    public static function post(
        string $route,
        string $controller,
        string $method,
        array $roles = []
    ): void {
        self::register('post', $route, $controller, $method, $roles);
    }
    
    private static function register(
        string $type,
        string $uri,
        string $controller,
        string $method,
        array $roles = []
    ): void {
        if (!class_exists($controller)) {
            throw new \RuntimeException("Wrong controller '{$controller}'");
        }
    
        if (!method_exists($controller, $method)) {
            throw new \RuntimeException("Wrong controller '{$controller}' method '{$method}'");
        }
        
        self::$routes[$uri] = new Route($type, $uri, $controller, $method, $roles);
    }
}