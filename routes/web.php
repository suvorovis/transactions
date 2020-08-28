<?php

use transactions\Controllers\LoginController;
use transactions\Controllers\UsersController;
use transactions\Enums\Roles;
use transactions\Router;

Router::get('', UsersController::class, 'show', [Roles::USER]);
Router::get('users/show', UsersController::class, 'show', [Roles::USER]);
Router::post('users/update', UsersController::class, 'update', [Roles::USER]);

Router::get('login', LoginController::class, 'show');
Router::post('auth', LoginController::class, 'auth');