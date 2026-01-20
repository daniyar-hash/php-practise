<?php 


const MIDDLEWARE = [
    'auth' => \myframew\middleware\Auth::class,
    'guest' =>\myframew\middleware\Guest::class,
];

//**@var $router */

$router->get('', 'posts/index.php');
$router->get('posts', 'posts/show.php');
$router->get('posts/create','posts/create.php')->only('auth');

$router->post('posts', 'posts/store.php');
$router->delete('posts', 'posts/destroy.php');

$router->get('about', 'about.php');
$router->get('contact', 'contact.php');

$router->get('register', 'users/register.php')->only('guest');
$router->get('login', 'users/login.php')->only('guest');
$router->get('logout', 'users/logout.php');









