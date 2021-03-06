<?php

namespace transactions\Controllers;

use transactions\Exceptions\DatabaseQueryException;
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
    
    /**
     * UsersController constructor.
     *
     * @param Request        $request
     * @param Validator      $validator
     * @param UserRepository $repository
     */
    public function __construct(Request $request, Validator $validator, UserRepository $repository)
    {
        parent::__construct($request, $validator);
        $this->repository = $repository;
    }
    
    /**
     * @return array
     *
     * @throws DatabaseQueryException
     */
    public function show(): array
    {
        $user = $this->repository->getByLogin(Session::login());
        if ($user->getId() === 0) {
            Session::stop();
            Session::set('message', 'Fail: authorize error');
            Router::redirect('login');
        }
        
        $balance = number_format($user->getBalance(), 2, '.', '');
        
        return [
            'title'   => 'Profile',
            'content' => new View('users/show', compact('balance')),
        ];
    }
    
    /**
     * @throws DatabaseQueryException
     */
    public function withdraw(): void
    {
        $user = $this->repository->getByLogin(Session::login());
        if ($user->getId() === 0) {
            Session::stop();
            Session::set('message', 'Fail: authorize error');
            Router::redirect('login');
        }
        
        $amount = $this->request->getParam('amount');
        if (!$this->validator->isAmount($amount)) {
            Session::set('message', 'Fail: wrong amount');
            Router::redirect('users/show');
        }
        
        $result = $this->repository->withdraw($user->getId(), $amount);
        if (!$result) {
            Session::set('message', 'Fail: insufficient funds');
            Router::redirect('users/show');
        }
    
        Session::set('message', 'Success');
        Router::redirect('users/show');
    }
}
