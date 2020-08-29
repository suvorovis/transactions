<?php

namespace transactions\Controllers;

use transactions\Request;
use transactions\Services\Validator;

abstract class AbstractController
{
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var Validator
     */
    protected $validator;
    
    public function __construct(Request $request, Validator $validator)
    {
        $this->request = $request;
        $this->validator = $validator;
    }
}