<?php

use Septillion\Classes\Router;
use Septillion\Classes\Request;

require __DIR__ .'/../../vendor/autoload.php';

// For now we envoke the Request right here, until we find a better place fo that
Request::getInstance();

Router::get('/blog/posts/:id', function(Request $req){
    echo 'this is a post with id ' . $req->params->id;
});

Router::get('/blog', 'test@helloWorld');

// Router::get('/blog/:id', 'test@action');
Router::get('/blog/comments/:id', 'test@helloWorld');