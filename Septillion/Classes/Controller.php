<?php

namespace Septillion\Classes;


class Controller
{
    private static $controllerName;
    private static $controllerAction;

    public static function findController($controllerName, $controllerAction)
    {
        
    }

    public static function exe($controllerName, $controllerAction, $routerParameteres)
    {
        echo $controllerName.'<br/>';
        echo $controllerAction;
    }
}