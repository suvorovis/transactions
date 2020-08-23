<?php

namespace transactions;

use ReflectionException;

class Application
{
    /**
     * @throws ReflectionException
     */
    public function run(): void
    {
        $container = new Container();
        $request = $container->get(Request::class);
        $router = $container->get(Router::class);
        
        /** @var Route $route */
        $route = $router->getRoute($request);
        
        $controller = $container->get($route->getController());
        
        echo $controller->{$route->getMethod()}();
    }
}