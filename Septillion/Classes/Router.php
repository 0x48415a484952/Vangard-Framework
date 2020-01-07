<?php

namespace Septillion\Classes;
use Septillion\Classes\Request;
use Septillion\Classes\Helper;

class Router
{
    private $route;
    private $request;
    private $isMatch;
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

    private function setIsMatch($bool)
    {
        $this->isMatch = $bool;
    }

    private function getIsMatch()
    {
        return $this->isMatch;
    }

    private function checkRoute($route)
    {
        $routerParameteres = [];
        $this->isMatch = true;
        $explodedRoute = explode('/', $route);
        $request = Request::request();
        $request = Helper::removeTrailingSlash($request);
        $explodedRequest = explode('/', $request);
        if( count($explodedRequest) == count($explodedRoute) ) {
            foreach($explodedRoute as $key => $value) {
                if( !array_key_exists($key, $explodedRequest) ){
                    $this->isMatch = false;
                    break;
                }

                if(preg_match('/^:/', $value)) {
                    $trimedValue = substr($value, 1);
                    $routerParameteres[$trimedValue] = $explodedRequest[$key];    
                } else {
                    if( $value != $explodedRequest[$key] ){
                        $this->isMatch = false;
                        break;
                    }
                }
            }
            if($this->isMatch) {
                return $this->routerParameteres = $routerParameteres;
            }
        } else {
            $this->isMatch = false;
            return $this->isMatch;
        }
    }

    public static function get($route, $controller = null, callable $function)
    {
        $router = new self;
        if($router->checkRoute($route)) {
            call_user_func($function);
        }
        //if the route is match we can find the called controller and pass the $router which contains the route parameteres 
        //to that specific controller
        return $router;
    }



    // public function get($route, $controller = null, callable $function)
    // {
    //     if($this->checkRoute($route)) {
    //         call_user_func($function);
    //     } else {
    //         $view404 = new View();
    //         return $view404->renderView(['NOT FOUND 404']);
    //     }
    //     return $this->routerParameteres;
    // }
}