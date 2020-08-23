<?php

namespace transactions\Controllers;

use transactions\View;

class UsersController extends AbstractController
{
    public function show()
    {
        return (new View('users/show', $this->request->getParams()))->render();
    }
    
    public function update()
    {
        return 1;
    }
}