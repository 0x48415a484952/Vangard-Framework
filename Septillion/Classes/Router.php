<?php

namespace Septillion\Classes;
use Septillion\Classes\Request;
use Septillion\Classes\Helper;

class Router
{
    private $route;
    private $request;
    private $routerParameteres;

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

    private function isRouteMatch($route)
    {
        $routerParameteres = [];
        $explodedRoute = explode('/', $route);
        $request = Request::request();
        $request = Helper::removeTrailingSlash($request);
        $explodedRequest = explode('/', $request);
        if( count($explodedRequest) != count($explodedRoute) ) return false;

        foreach($explodedRoute as $key => $value) {
            if( !array_key_exists($key, $explodedRequest) ) return false;

            if(preg_match('/^:/', $value)) {
                $trimedValue = substr($value, 1);
                $routerParameteres[$trimedValue] = $explodedRequest[$key];    
            } else {
                if( $value != $explodedRequest[$key] ) return false;
            }
        }

        if( count($routerParameteres) ) $this->routerParameteres = $routerParameteres;

        return true;
    }

    public static function get($route, $controller = null, callable $function)
    {
        $router = new self;
        if($router->isRouteMatch($route)) {
            call_user_func($function);
        }
        //if the route is match we can find the called controller and pass the $router which contains the route parameteres 
        //to that specific controller
        return $router;
    }



    // public function get($route, $controller = null, callable $function)
    // {
    //     if($this->isRouteMatch($route)) {
    //         call_user_func($function);
    //     } else {
    //         $view404 = new View();
    //         return $view404->renderView(['NOT FOUND 404']);
    //     }
    //     return $this->routerParameteres;
    // }
}