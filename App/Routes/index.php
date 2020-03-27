<?php

namespace Septillion\App\Routes;

use Septillion\Framework\Middleware\MiddlewareStack;
use Septillion\Framework\Response\Response;
use Septillion\Framework\Router\Router;
use Septillion\Framework\Request\Request;

require __DIR__ .'/../../vendor/autoload.php';

// For now we invoke the Request right here, until we find a better place fo that
// Request::getInstance();

//$middleware = new MiddlewareStack();
//$middleware->run(Request::getInstance());
//dd('done');

Router::get('/Septillion/posts/:id', static function(Request $req) {
    $response = new Response('this is a post with id ' . $req->params->getItem('id'));
    $response->send(['CT' => 'text/h',]);
});


Router::get('/Septillion/posts/:id/book', static function(Request $req) {
    echo 'this is a book with id ' . $req->params->getItem('id');
});

Router::post('/Septillion/posts/:id/book', static function(Request $req) {
    echo 'this is a book with id and the method is post ' . $req->params->getItem('id');
});

// Router::get('/Septillion/:id', 'Home@helloWorld');

Router::resource('/Septillion/:id/book', 'Book');
Router::resource('/Septillion/comment', 'Home');
