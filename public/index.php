<?php

namespace transactions;

use Exception;

require_once '../vendor/autoload.php';
require_once '../routes/web.php';
require_once '../config/config.php';
require_once '../helpers/session.php';
require_once '../helpers/config.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

$app = new Application();

try {
    echo $app->run();
} catch (Exception $e) {
    echo $app->handleException($e);
}
