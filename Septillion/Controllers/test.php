<?php

namespace Septillion\Controllers;

use Septillion\Classes\Controller;

class Test
{
    public function action($param)
    {
        echo $param;
    }

    public function helloWorld($param)
    {
        echo 'hello ' . $param;
    }
}