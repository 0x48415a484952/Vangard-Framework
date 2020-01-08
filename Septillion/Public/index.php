<?php

use Septillion\Classes\Controller;
use Septillion\Classes\Router;

require __DIR__ .'/../../vendor/autoload.php';

// print_r(Router::get('/blog/posts/:id', null));
// print_r(Router::get('/blog/', null));


//the problem with this router is that it will create an instance if the match is true or not which is not 
//very efficient // i have to refactor it to create the instance after the match is found!
//also for the home page it does not work like '/blog' or even '/blog/' the url in the browser is like this:
    //    'localhost:8888/blog/' and yet we have to declare the router as below to work for homepage


Router::get('/blog/posts/:id', function(){
    echo 'this is a post';
});

// Router::get('/blog/posts/comments/:id', function(){
//     echo 'this is idk';
// });

// Router::get('/blog', function(){
//     echo 'this is home page';
//     // echo 'no shit!!';
// });

Router::get('/blog', function() {
    echo 'this is home page';
});

Router::get('/blog/:id', 'test@action');







// $router = new Router();

// $router->get('/blog/posts/:id', null, function(){
//     echo 'this is a post';
// });

// $router->get('/blog', null, function(){
//     echo 'this is the home';
// });

// $router->get('/blog', null, function(){
//     echo 'this is homepage';
// });