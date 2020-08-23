<?php
require_once '../vendor/autoload.php';
require_once '../routes/web.php';

$app = new transactions\Application();
$app->run();

//TODO:
//session
//model
//config
//exception handle
//layout
//database driver
//transaction+high load
//annotations
//class moving
//tests
//php ini show notices
//no route exception
//exceptions hierarchy
//github