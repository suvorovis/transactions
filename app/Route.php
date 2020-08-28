<?php

namespace transactions;

class Route
{
    private $type;
    private $path;
    private $controller;
    private $method;
    private $roles;
    
    /**
     * Route constructor.
     *
     * @param string $type
     * @param string $path
     * @param string $controller
     * @param string $method
     * @param array  $roles
     */
    public function __construct(string $type, string $path, string $controller, string $method, array $roles)
    {
        $this->type = $type;
        $this->path = $path;
        $this->controller = $controller;
        $this->method = $method;
        $this->roles = $roles;
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
    
    public function getRoles(): array
    {
        return $this->roles;
    }
    
    public function allowedToAll(): bool
    {
        return empty($this->roles);
    }
    
    public function allowedTo(string $role): bool
    {
        return $this->allowedToAll() || in_array($role, $this->roles, true);
    }
}