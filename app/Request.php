<?php

namespace transactions;

class Request
{
    /**
     * @var string
     */
    private $uri;
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $type;
    /**
     * @var array
     */
    private $params;
    
    /**
     * Request constructor.
     */
    public function __construct()
    {
        $this->uri = urldecode($_SERVER['REQUEST_URI'] ?? '');
        $this->type = strtolower($_SERVER['REQUEST_METHOD'] ?? 'GET');
        $this->params = $_REQUEST ?? [];
        $this->path = trim(explode('?', $this->uri)[0] ?? '', '/');
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
    public function getUri(): string
    {
        return $this->uri;
    }
    
    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->params;
    }
    
    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }
    
    /**
     * @param string $name
     * @param bool   $escape
     *
     * @return string
     */
    public function getParam(string $name, bool $escape = true): string
    {
        $param = trim($this->params[ $name ] ?? '');
        if ($escape) {
            $param = htmlspecialchars($param);
        }
        return $param;
    }
}
