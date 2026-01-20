<?php


session_start();

require __DIR__  . "/../vendor/autoload.php";

require dirname(__DIR__) . '/config/config.php';
require_once __DIR__ . '/bootstrap.php';
require CORE . '/funcs.php';

// db() = \myframew\App::get(\myframew\Db::class);

$router = new \myframew\Router();

require CONFIG . '/routes.php';


$router->match();





















