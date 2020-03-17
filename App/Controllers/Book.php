<?php

namespace Septillion\App\Controllers;

use Septillion\Framework\Request\Request;

class Book
{
    public function helloWorld(Request $req)
    {
        echo 'id is ' . $req->params->id;
    }

    public function index(Request $req)
    {
        echo 'this is the index fucntion';
        echo '<br>';
        echo 'id is ' . $req->params->id;
    }

    public function show(Request $req)
    {
        echo 'this is the show function';
        echo '<br>';
        echo 'id is ' . $req->params->id;
    }

    public function store(Request $req)
    {
        echo 'this is the post fucntion';
        echo '<br>';
        echo 'id is ' . $req->params->id;
        echo '<br>';
        echo 'post body sent as id is ' . $req->body->id;
        echo '<br>';
        echo 'post body sent as string is' . $req->body->string;
        echo '<br>';
        if ($req->body->whatever) echo 'post body sent as whatever is' . $req->body->whatever;
    }

    public function update(Request $req)
    {
        echo 'this is the update function';
        echo '<br>';
        echo 'id is ' . $req->params->id;
    }

    public function destroy(Request $req)
    {
        echo 'this is the delete function';
        echo '<br>';
        echo 'id is ' . $req->params->id;
    }
}