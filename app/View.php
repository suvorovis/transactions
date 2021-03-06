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
    
    /**
     * View constructor.
     *
     * @param string $path
     * @param array  $params
     */
    public function __construct(string $path, array $params = [])
    {
        $this->path = $path;
        $this->params = array_map(static function ($param) {
            return is_a($param, self::class) ? $param->render() : $param;
        }, $params);
    }
    
    /**
     * @return string
     */
    public function render(): string
    {
        extract($this->params, EXTR_SKIP);
        ob_start();
        include("../templates/{$this->path}.html");
        return ob_get_clean();
    }
}
