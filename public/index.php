<?php

namespace transactions;

require_once '../vendor/autoload.php';
require_once '../routes/web.php';
require_once '../config/config.php';

$app = new Application();
echo $app->run();

//TODO:
//exceptions hierarchy
//exception handle
//no route exception
//logs

//php ini show notices

//annotations

//readme

//csrf
//session expire

//ajax
//bootstrap