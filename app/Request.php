<?php

namespace transactions;

class Request
{
    private $uri;
    private $path;
    private $type;
    private $params;
    
    public function __construct()
    {
        $this->uri = urldecode($_SERVER['REQUEST_URI'] ?? '');
        $this->type = strtolower($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $this->params = $_REQUEST ?? [];
        $this->path = trim(explode('?', $this->uri)[0] ?? '', '/');
    }
    
    public function getType(): string
    {
        return $this->type;
    }
    
    public function getUri(): string
    {
        return $this->uri;
    }
    
    public function getParams(): array
    {
        return $this->params;
    }
    
    public function getPath(): string
    {
        return $this->path;
    }
    
    public function getParam(string $name, bool $escape = true): string
    {
        $param = $this->params[$name] ?? '';
        if ($escape) {
            $param = htmlspecialchars($param);
        }
        return $param;
    }
}