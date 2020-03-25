<?php

namespace Septillion\App\Controllers;

use Septillion\Framework\Controller\Controller;
use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

class Book extends Controller
{
    public function helloWorld(Request $req)
    {
        echo 'id is ' . $req->params->getItem('id');
    }

    public function index(Request $req): void
    {
//        $response = new Response('is is '. $req->params->id, null, null);
//        echo $response;
//        echo 'id is ' . $req->params->id;
    }

    public function show(Request $req)
    {
        echo 'this is the show function';
        echo '<br>';
        echo 'id is ' . $req->params->getItem('id');
    }

    public function store(Request $req)
    {
        $response = new Response('this is a response object');
        $response->send();
        echo '<br>';
        echo 'this is the post function';
        echo '<br>';
        echo 'id is '. $req->params->getItem('id');
//        echo 'id is ' . $req->params->id;
        echo '<br>';
        echo 'post body sent as id is ' . $req->body->getItem('id');
        echo '<br>';
        echo 'post body sent as string is' . $req->body->getItem('string');
        echo '<br>';
        if ($req->body->getItem('whatever')) echo 'post body sent as whatever is' . $req->body->getItem('whatever');
    }

    public function update(Request $req)
    {
        echo 'this is the update function';
        echo '<br>';
        echo 'id is ' . $req->params->getItem('id');
    }

    public function destroy(Request $req)
    {
        echo 'this is the delete function';
        echo '<br>';
        echo 'id is ' . $req->params->getItem('id');
    }
}