<?php

namespace transactions\Controllers;

use transactions\Repositories\UserRepository;
use transactions\Request;
use transactions\Router;
use transactions\Services\Validator;
use transactions\Session;
use transactions\View;

class UsersController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;
    
    public function __construct(Request $request, Validator $validator, UserRepository $repository)
    {
        parent::__construct($request, $validator);
        $this->repository = $repository;
    }
    
    public function show(): array
    {
        $user = $this->repository->getByLogin(Session::login());
        if ($user->getId() === 0) {
            Session::stop();
            Router::redirect('login');
        }
        
        $balance = number_format($user->getBalance(), 2, '.', '');
        
        return [
            'title' => 'Profile',
            'content' => new View('users/show', compact('balance')),
        ];
    }
    
    public function withdraw(): void
    {
        $user = $this->repository->getByLogin(Session::login());
        if ($user->getId() === 0) {
            Session::stop();
            Router::redirect('login');
        }
        
        $amount = $this->request->getParam('amount');
        if (!$this->validator->isAmount($amount)) {
            $message = 'Fail: wrong amount';
            Router::redirect("users/show?message={$message}");
        }
        
        $result = $this->repository->withdraw($user->getId(), $amount);
        if (!$result) {
            $message = 'Fail: insufficient funds';
            Router::redirect("users/show?message={$message}");
        }
        
        Router::redirect('users/show?message=Success');
    }
}