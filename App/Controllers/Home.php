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

    public function store()
    {
        echo 'this is the post fucntion';
    }
}