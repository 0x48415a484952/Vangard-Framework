<?php

namespace Septillion\App\Routes;

use Septillion\Framework\Router\Router;
use Septillion\Framework\Request\Request;

require __DIR__ .'/../../vendor/autoload.php';
// require __DIR__ .'/../../../vendor/autoload.php';

// For now we envoke the Request right here, until we find a better place fo that
Request::getInstance();

Router::get('/Septillion/posts/:id', function(Request $req){
    echo 'this is a post with id ' . $req->params->id;
});



// Router::get('/Septillion/:id', 'Home@helloWorld');

Router::resource('/Septillion/comment', 'Home');

