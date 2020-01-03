<?php

require __DIR__ .'/../../vendor/autoload.php';

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    case '/blog/Septillion/' :
        require __DIR__ . '/../Views/index.php';
        break;
    case '/blog/Septillion/home' :
        require __DIR__ . '/../Views/index.php';
        break;
    case '/blog/Septillion/about' :
        require __DIR__ . '/../Views/about.php';
        break;
    case '/blog/Septillion/post' :
        require __DIR__ . '/../Views/post.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/../Views/404.php';
        break;
}