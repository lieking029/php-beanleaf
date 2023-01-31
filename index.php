<?php

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];


$routes = [
    '/dashboard' => 'views/pages/index.php',
    '/login' => 'controller/auth/login.controller.php',
    '/register' => 'controller/auth/register.controller.php',
    '/logout' => 'views/pages/auth/logout.php',
    '/create-post' => 'views/pages/post/create.post.php',
    '/update-profile' => 'views/pages/updateProfile.php',
];


function abort() {
    http_response_code();

    require 'views/pages/404.php';

    die();
}

if (array_key_exists($uri, $routes)) {
    require $routes[$uri];
} else {
    abort();
}

?>