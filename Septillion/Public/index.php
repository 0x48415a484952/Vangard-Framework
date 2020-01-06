<?php

use Septillion\Classes\Router;

require __DIR__ .'/../../vendor/autoload.php';

// print_r(Router::get('/blog/posts/:id', null));
// print_r(Router::get('/blog/', null));


Router::get('/blog/posts/:id', null, function(){
    echo 'this is a post';
});

Router::get('/blog/posts/comments/:id', null, function(){
    echo 'this is idk';
});