<?php

use transactions\Router;

Router::post('users/update', \transactions\Controllers\UsersController::class, 'update');
Router::get('users/show', \transactions\Controllers\UsersController::class, 'show');
Router::get('', \transactions\Controllers\UsersController::class, 'show');