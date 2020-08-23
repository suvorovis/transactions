<?php

namespace transactions;

class View
{
    /**
     * @var string
     */
    private $path;
    /**
     * @var array
     */
    private $params;
    
    public function __construct(string $path, array $params)
    {
        $this->path = "../templates/{$path}.html";
        $this->params = $params;
    }
    
    public function render()
    {
        extract($this->params, EXTR_OVERWRITE);
        ob_start();
        include($this->path);
        return ob_get_clean();
    }
}