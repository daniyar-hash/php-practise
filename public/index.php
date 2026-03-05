<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();

require __DIR__  . "/../vendor/autoload.php";

require dirname(__DIR__) . '/config/config.php';
require_once __DIR__ . '/bootstrap.php';
require CORE . '/funcs.php';


// $url = "#^posts/(?P<slug>[a-z0-9-]+)$#";
// $text = "posts/title-4";
// if(preg_match($url, $text, $matches)){

//     echo "ok";
//     print_arr($matches);
    

// }else{
//     echo "does not matches";
// }




// db() = \myframew\App::get(\myframew\Db::class);

$router = new \myframew\Router();

require CONFIG . '/routes.php'; 

$router->match();





















