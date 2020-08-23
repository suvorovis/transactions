<?php

namespace transactions\Controllers;

use transactions\Request;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}