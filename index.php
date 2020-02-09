<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

session_start();
ob_start("ob_gzhandler");

//$router = new Router();
//$router->run();

$route = new Route();
$route->run();

exit();