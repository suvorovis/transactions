<?php

namespace transactions\Controllers;

use transactions\Repositories\UserRepository;
use transactions\Request;
use transactions\Router;
use transactions\Services\PasswordManager;
use transactions\Services\Validator;
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
        Validator $validator,
        UserRepository $repository,
        PasswordManager $passwordManager
    ) {
        parent::__construct($request, $validator);
        $this->repository = $repository;
        $this->passwordManager = $passwordManager;
    }
    
    public function show(): array
    {
        if (Session::authorized()) {
            Router::redirect('');
        }
        
        return [
            'title' => 'Login',
            'content' => new View('login')
        ];
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
    
    public function logout(): void
    {
        if (!Session::authorized()) {
            Router::redirect('login');
        }
        
        Session::stop();
        Router::redirect('login');
    }
}