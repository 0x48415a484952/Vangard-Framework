<?php

namespace Septillion\App\Controllers;

use Septillion\Framework\Request\Request;

class Home
{
    public function helloWorld(Request $req)
    {
        echo 'id is ' . $req->params->id;
    }

    public function index()
    {
        echo 'this is the index fucntion';
    }

    public function show()
    {
        echo 'this is the show function';
    }

    public function store()
    {
        echo 'this is the post fucntion';
    }

    public function update()
    {
        echo 'this is the update function';
    }

    public function destroy()
    {
        echo 'this is the delete function';
    }


}