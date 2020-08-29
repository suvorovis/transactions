<?php

namespace transactions;

class Route
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $method;
    /**
     * @var array
     */
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
    
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    
    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
    
    /**
     * @return string
     */
    public function getController(): string
    {
        return $this->controller;
    }
    
    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }
    
    /**
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
    
    /**
     * @return bool
     */
    public function allowedToAll(): bool
    {
        return empty($this->roles);
    }
    
    /**
     * @param string $role
     *
     * @return bool
     */
    public function allowedTo(string $role): bool
    {
        return $this->allowedToAll() || in_array($role, $this->roles, true);
    }
}
