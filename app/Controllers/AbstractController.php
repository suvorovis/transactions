<?php

namespace transactions\Controllers;

use transactions\Request;
use transactions\View;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var View
     */
    protected $view;
    
    public function __construct(Request $request, View $view)
    {
        $this->request = $request;
        $this->view = $view;
    }
}