<?php

namespace transactions;

use Exception;
use ReflectionException;
use transactions\Exceptions\AccessDeniedException;
use transactions\Exceptions\DatabaseConnectionException;
use transactions\Exceptions\DatabaseQueryException;
use transactions\Exceptions\NotFoundException;
use transactions\Exceptions\ServiceTreeConstructException;
use transactions\Exceptions\WrongControllerResponseException;

class Application
{
    /**
     * @return string
     * @throws ReflectionException|ServiceTreeConstructException|NotFoundException|AccessDeniedException
     * @throws WrongControllerResponseException|DatabaseQueryException|DatabaseConnectionException
     */
    public function run(): string
    {
        Session::start();
    
        if (Session::authorized() && Session::expired()) {
            Session::stop();
            Session::set('message', 'Session expired');
            Router::redirect('login');
        }
        
        if (Session::authorized()) {
            Session::refresh();
        }
        
        $container = new Container();
        $request = $container->get(Request::class);
        $router = $container->get(Router::class);
        
        /** @var Route $route */
        $route = $router->getRoute($request);
        
        if (!$route->allowedToAll() && !Session::authorized()) {
            Router::redirect('login');
        }
        
        if (!$route->allowedTo(Session::role())) {
            throw new AccessDeniedException('Access denied');
        }
        
        $controller = $container->get($route->getController());
        
        $response = $controller->{$route->getMethod()}();
        
        if (is_string($response)) {
            return $response;
        }
        
        if (is_array($response)) {
            return (new View('layout', [
                'title'   => $response['title'] ?? '',
                'content' => $response['content'] ?? '',
            ]))->render();
        }
        
        throw new WrongControllerResponseException('Wrong response format');
    }
    
    /**
     * @param Exception $e
     *
     * @return string
     */
    public function handleException(Exception $e): string
    {
        error_log("Error {$e->getCode()}({$e->getFile()} {$e->getLine()}):\n{$e->getMessage()}\n{$e->getTraceAsString()}");
    
        return (new View('layout', [
            'title'   => 'Error occurred',
            'content' => method_exists($e, 'getUserErrorDescription') ?
                $e->getUserErrorDescription() :
                'Something went wrong',
        ]))->render();
    }
}
