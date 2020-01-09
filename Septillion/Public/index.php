<?php

use Septillion\Classes\Controller;
use Septillion\Classes\Router;


require __DIR__ .'/../../vendor/autoload.php';

Router::get('/blog/posts/:id', function(){
    echo 'this is a post';
});

Router::get('/blog', function() {
    echo 'this is home page';
});

Router::get('/blog/:id', 'test@action');