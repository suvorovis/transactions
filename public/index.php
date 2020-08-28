<?php
require_once '../vendor/autoload.php';
require_once '../routes/web.php';
require_once '../config/config.php';

$app = new transactions\Application();
$app->run();

//TODO:
//layout


//exception handle

//transaction+high load
//annotations
//class moving
//tests
//php ini show notices
//no route exception
//exceptions hierarchy
//use bcmath
//readme
//csrf
//session expire
//logs