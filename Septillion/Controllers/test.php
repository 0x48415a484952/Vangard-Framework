<?php

namespace Septillion\Controllers;

use Septillion\Classes\View;

class Test
{
    public function action($param)
    {
        echo $param;
    }

    public function helloWorld()
    {
        $page = new View();
        $page->renderView([''], 'home');
    }
}