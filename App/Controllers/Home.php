<?php

namespace Septillion\App\Controllers;

use Septillion\Framework\Controller\Controller;
use Septillion\Framework\Request\Request;

class Home extends Controller
{
    public function helloWorld(Request $req)
    {
        echo 'id is ' . $req->params->id;
    }

    public function index()
    {
        echo 'this is the index fucntion';
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
        echo 'id is ' . $req->body;
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