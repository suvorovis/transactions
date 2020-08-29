<?php

namespace transactions;

use transactions\Enums\RequestTypes;
use transactions\Exceptions\NotFoundException;

class Router
{
    /**
     * @var array
     */
    private static $routes = [];
    
    /**
     * @param Request $request
     *
     * @return Route
     * @throws NotFoundException
     */
    public function getRoute(Request $request): Route
    {
        if (!isset(self::$routes[ $request->getPath() ])) {
            throw new NotFoundException("Wrong route '{$request->getPath()}'");
        }
        
        /** @var Route $route */
        $route = self::$routes[ $request->getPath() ];
        
        if ($request->getType() !== $route->getType()) {
            throw new NotFoundException("Wrong route '{$request->getPath()}' type '{$request->getType()}'");
        }
        
        return $route;
    }
    
    /**
     * @param string $uri
     * @param array  $params
     */
    public static function redirect(string $uri, array $params = []): void
    {
        if (!empty($params)) {
            $uri .= '?' . http_build_query($params);
        }
        
        header("Location: /{$uri}");
        die();
    }
    
    /**
     * @param string $route
     * @param string $controller
     * @param string $method
     * @param array  $roles
     *
     * @throws NotFoundException
     */
    public static function get(
        string $route,
        string $controller,
        string $method,
        array $roles = []
    ): void {
        self::register(RequestTypes::GET, $route, $controller, $method, $roles);
    }
    
    /**
     * @param string $route
     * @param string $controller
     * @param string $method
     * @param array  $roles
     *
     * @throws NotFoundException
     */
    public static function post(
        string $route,
        string $controller,
        string $method,
        array $roles = []
    ): void {
        self::register(RequestTypes::POST, $route, $controller, $method, $roles);
    }
    
    /**
     * @param string $type
     * @param string $uri
     * @param string $controller
     * @param string $method
     * @param array  $roles
     *
     * @throws NotFoundException
     */
    private static function register(
        string $type,
        string $uri,
        string $controller,
        string $method,
        array $roles = []
    ): void {
        if (!class_exists($controller)) {
            throw new NotFoundException("Wrong controller '{$controller}'");
        }
        
        if (!method_exists($controller, $method)) {
            throw new NotFoundException("Wrong controller '{$controller}' method '{$method}'");
        }
        
        self::$routes[ $uri ] = new Route($type, $uri, $controller, $method, $roles);
    }
}
