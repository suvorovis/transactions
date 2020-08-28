<?php

namespace transactions\Controllers;

use transactions\Repositories\UserRepository;
use transactions\Request;
use transactions\Router;
use transactions\Services\PasswordManager;
use transactions\Session;
use transactions\View;

class LoginController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var PasswordManager
     */
    private $passwordManager;
    
    public function __construct(
        Request $request,
        View $view,
        UserRepository $repository,
        PasswordManager $passwordManager
    ) {
        parent::__construct($request, $view);
        $this->repository = $repository;
        $this->passwordManager = $passwordManager;
        $this->view = $view;
    }
    
    public function show(): string
    {
        if (Session::authorized()) {
            Router::redirect('');
        }
        
        return $this->view->render('login');
    }
    
    public function auth(): void
    {
        if (Session::authorized()) {
            Router::redirect('');
        }
    
        $login = $this->request->getParam('login');
        $user = $this->repository->getByLogin($login);
        if ($user->getId() === 0) {
            Router::redirect('login');
        }
    
        $password = $this->request->getParam('password');
        if (!$this->passwordManager->verify($password, $user->getPassword())) {
            Router::redirect('login');
        }
        
        Session::authorize($user->getLogin(), $user->getRole());
        Router::redirect('');
    }
}