<?php

namespace transactions;

class Route
{
    private $type;
    private $path;
    private $controller;
    private $method;
    
    /**
     * Route constructor.
     *
     * @param string $type
     * @param string $path
     * @param string $controller
     * @param string $method
     */
    public function __construct(string $type, string $path, string $controller, string $method)
    {
        $this->type = $type;
        $this->path = $path;
        $this->controller = $controller;
        $this->method = $method;
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getPath(): string
    {
        return $this->path;
    }
    
    public function getController(): string
    {
        return $this->controller;
    }
    
    public function getMethod(): string
    {
        return $this->method;
    }
}