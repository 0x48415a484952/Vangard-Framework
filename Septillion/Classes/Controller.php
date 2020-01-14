<?php

namespace Septillion\Classes;

class Controller
{
    private $controllerName;
    private $controllerAction;

    public static function exe($controllerObject, $controllerAction, $request)
    {
        if($controllerObject) {
            /* ================ Left for Hazhir to Implement a Better Strategy ============= */
            // if($routerParameteres == null) {
                return call_user_func([$controllerObject, $controllerAction], $request);
            // }
            // return call_user_func_array([$controllerObject, $controllerAction], $routerParameteres);
        } else {
            echo 'controller not defined';
        }
        
    }
}