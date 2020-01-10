<?php

namespace Septillion\Classes;

class Controller
{
    private $controllerName;
    private $controllerAction;

    public static function exe($controllerObject, $controllerAction, $routerParameteres = null)
    {
        if($controllerObject) {
                if($routerParameteres == null) {
                    return call_user_func([$controllerObject, $controllerAction]);
                }
                return call_user_func_array([$controllerObject, $controllerAction], $routerParameteres);
        } else {
            echo 'controller not defined';
        }
        
    }
}