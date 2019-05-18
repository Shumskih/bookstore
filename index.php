<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

session_start();
ob_start("ob_gzhandler");

$router = new Router();
$router->route();

exit();
