<?php

namespace Septillion\Framework\Router;

use Septillion\Framework\Request\Request;
use Septillion\Framework\Controller\Controller;

class Router
{
    private static $route;
    private static $request;
    private static $routerParameteres;

    public function __construct()
    {
        
    }

    private function setRoute($route)
    {
        $this->route = $route;
    }

    private function getRoute()
    {
        return $this->route;
    }

    private static function checkAction($actionName)
    {

    }

    private static function checkController($path) 
    {

    }

    private static function isRouteMatch($route)
    {
        $routerParameteres = [];
        $explodedRoute = explode('/', $route);
        $request = Request::getInstance();
        if(count($request->uriParts) != count($explodedRoute)) return false;
        foreach($explodedRoute as $key => $value) {
            if(!array_key_exists($key, $request->uriParts)) return false;
            if(preg_match('/^:/', $value)) {
                $trimedValue = substr($value, 1);
                $routerParameteres[$trimedValue] = $request->uriParts[$key];    
            } else {
                if($value != $request->uriParts[$key]) return false;
            }
        }
        if(count($routerParameteres)) $request->params->set($routerParameteres);
        return true;
    }

    public static function get($route, $controller)
    {
        if(self::isRouteMatch($route)) {
            if(is_callable($controller)) {
                call_user_func($controller, Request::getInstance());
            } else {
                if(preg_match('/[a-zA-Z]+([0-9]+)?[a-zA-Z]+@[a-zA-Z0-9]+/', $controller)) {
                    $explodedController = explode('@', $controller);
                    $controllerName = "Septillion\\App\\Controllers\\".$explodedController[0];
                    $controllerAction = $explodedController[1];
                    $controllerObject = new $controllerName();
                    Controller::exe($controllerObject, $controllerAction, Request::getInstance());
                }
            }
        } 
    }
}