<?php

namespace transactions;

use ReflectionException;
use RuntimeException;

class Application
{
    /**
     * @throws ReflectionException
     */
    public function run(): string
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
        
        $response = $controller->{$route->getMethod()}();
    
        if (is_string($response)) {
            return $response;
        }
        
        if (is_array($response)) {
            return (new View('layout', [
                'title' => $response['title'] ?? '',
                'content' => $response['content'] ?? '',
                'message' => $request->getParam('message'),
            ]))->render();
        }
        
        throw new RuntimeException('Wrong response format');
    }
}