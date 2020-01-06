<?php

namespace Septillion\Classes;
use Septillion\Classes\Request;
use Septillion\Classes\View;

class Router
{
    private $route;
    private $request;
    private $isMatch;

    public function __construct()
    {
        
    }

    public function setRoute($route)
    {
        $this->route = $route;
    }

    public function getRoute()
    {
        return $this->route;
    }

    public function setIsMatch($bool)
    {
        $this->isMatch = $bool;
    }

    public function getIsMatch()
    {
        return $this->isMatch;
    }

    public function checkRoute($route)
    {
        $routerParameteres = [];
        $this->isMatch = true;
        $explodedRoute = explode('/', $route);
        $explodedRequest = explode('/', Request::request());
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
                return $routerParameteres;
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
        return $router;
    }
}