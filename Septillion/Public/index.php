<?php

use Septillion\Classes\Router;


require __DIR__ .'/../../vendor/autoload.php';

Router::get('/blog/posts/:id', function(){
    echo 'this is a post';
});

Router::get('/blog', 'test@helloWorld');

// Router::get('/blog/:id', 'test@action');
Router::get('/blog/comments/:id', 'test@helloWorld');