<?php

declare(strict_types=1);

namespace Septillion\App\Controllers;

use Septillion\Framework\Request\Request;

class Test
{
    public function action($param)
    {
        echo $param;
    }

    public function helloWorld(Request $req)
    {
        echo 'id is ' . $req->params->id;
    }
}