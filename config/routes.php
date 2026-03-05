<?php 


const MIDDLEWARE = [
    'auth' => \myframew\middleware\Auth::class,
    'guest' =>\myframew\middleware\Guest::class,
];

//**@var $router */




$router->get('', 'posts/index.php');
$router->get('posts/create','posts/create.php')->only('auth');

$router->get('posts/(?P<slug>[a-z0-9-]+)', 'posts/show.php');

$router->post('posts', 'posts/store.php');
$router->delete('posts', 'posts/destroy.php');

$router->get('about', 'about.php');
$router->get('contact', 'contact.php');

$router->add('register', 'users/register.php', ['get', 'post'])->only('guest'); 
//$router->post('register', 'users/store.php')->only('guest'); 

$router->add('login', 'users/login.php', ['get', 'post'])->only('guest');

$router->get('logout', 'users/logout.php');









