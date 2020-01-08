<?php

namespace Septillion\Classes;
use Septillion\Classes\Request;
use Septillion\Classes\Helper;
use Septillion\Classes\Controller;

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
        $request = Request::request();
        $request = Helper::removeTrailingSlash($request);
        $explodedRequest = explode('/', $request);
        if(count($explodedRequest) != count($explodedRoute)) return false;
        foreach($explodedRoute as $key => $value) {
            if(!array_key_exists($key, $explodedRequest)) return false;
            if(preg_match('/^:/', $value)) {
                $trimedValue = substr($value, 1);
                $routerParameteres[$trimedValue] = $explodedRequest[$key];    
            } else {
                if($value != $explodedRequest[$key]) return false;
            }
        }
        if(count($routerParameteres)) self::$routerParameteres = $routerParameteres;
        return true;
    }

    public static function get($route, $controller)
    {
        if(self::isRouteMatch($route)) {
            if(is_callable($controller)) {
                call_user_func($controller);
            } else {
                if(preg_match('/[a-zA-Z]+([0-9]+)?[a-zA-Z]+@[a-zA-Z0-9]+/', $controller)) {
                    $explodedController = explode('@', $controller);
                    $controllerName = $explodedController[0];
                    $controllerAction = $explodedController[1];
                    Controller::exe($controllerName, $controllerAction, self::$routerParameteres);
                }
                //check for controller in Controllers Directory and action method
            }
        }
        // return self::$routerParameteres;
        // $view = new View();
        // return $view->renderView(['404 NOT FOUND']);
        //if the route is match we can find the called controller and pass the $router which contains the route parameteres 
        //to that specific controller
    }
}