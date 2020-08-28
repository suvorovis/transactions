<?php

namespace transactions\Controllers;

class UsersController extends AbstractController
{
    public function show(): string
    {
        return $this->view->render('users/show', $this->request->getParams());
    }
    
    public function update()
    {
        return 1;
    }
}