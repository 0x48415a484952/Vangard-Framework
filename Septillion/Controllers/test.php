<?php

namespace Septillion\Controllers;
use Septillion\Classes\View;
use Septillion\Classes\Request;

class Test
{
    public function action($param)
    {
        echo $param;
    }

    public function helloWorld(Request $req)
    {
        echo 'id is ' . $req->params->id;
        $page = new View();
        $page->renderView([''], 'home');
    }
}