<?php

namespace Septillion\App\Controllers;

use Septillion\Framework\Controller\Controller;
use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

class Home extends Controller
{
    public function helloWorld(Request $req)
    {
        echo 'id is ' . $req->params->getItem('id');
    }

    public function index(Request $req)
    {
//        echo 'this is the index function 123123';
//        echo '<br>';
        $id = 'id is'.$req->params->getItem('id');
        $response = new Response($id);
        $response->send();
    }

    public function show(Request $req)
    {
        echo 'this is the show function';
        echo '<br>';
        echo 'id is ' . $req->params->getItem('id');
    }

    public function store()
    {
        echo 'this is the post function';
        echo '<br>';
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