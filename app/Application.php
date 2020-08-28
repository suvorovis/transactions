<?php

namespace transactions;

use ReflectionException;
use RuntimeException;

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
        
        Session::start();
        
        if (!$route->allowedToAll() && !Session::authorized()) {
            Router::redirect('login');
        }
        
        if (!$route->allowedTo(Session::role())) {
            throw new RuntimeException('Access denied');
        }
        
        $controller = $container->get($route->getController());
        
        echo $controller->{$route->getMethod()}();
    }
}