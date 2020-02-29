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
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (count($explodedRoute) + 1 == count($request->uriParts)) {
                array_push($explodedRoute, ':septillion'.mt_rand(100000, 999999));
            }
        }

        if (count($request->uriParts) != count($explodedRoute)) return false;
        foreach ($explodedRoute as $key => $value) {
            if (!array_key_exists($key, $request->uriParts)) return false;
            if (preg_match('/^:/', $value)) {
                $trimedValue = substr($value, 1);
                $routerParameteres[$trimedValue] = $request->uriParts[$key];

                self::$routerParameteres[$trimedValue] = $request->uriParts[$key];

            } elseif ($value != $request->uriParts[$key]) return false;
        }
        if (count($routerParameteres)) $request->params->set($routerParameteres);
        return true;



        // $routerParameteres = [];
        // $explodedRoute = explode('/', $route);
        // $request = Request::getInstance();
        // if (count($request->uriParts) != count($explodedRoute)) return false;
        // foreach ($explodedRoute as $key => $value) {
        //     if (!array_key_exists($key, $request->uriParts)) return false;
        //     if (preg_match('/^:/', $value)) {
        //         $trimedValue = substr($value, 1);
        //         $routerParameteres[$trimedValue] = $request->uriParts[$key];    
        //     } elseif ($value != $request->uriParts[$key]) return false;
        // }
        // if (count($routerParameteres)) $request->params->set($routerParameteres);
        // return true;
    }

    private static function findingAndExecutingController($controller)
    {
        $controllerAction = null;
        $controllerObject = null;
        if (preg_match('/[a-zA-Z]+([0-9]+)?[a-zA-Z]+@[a-zA-Z0-9]+/', $controller)) {
            $explodedController = explode('@', $controller);
            $controllerName = "Septillion\\App\\Controllers\\".$explodedController[0];
            $controllerObject = new $controllerName();
            $controllerAction = $explodedController[1];
            Controller::exe($controllerObject, $controllerAction, Request::getInstance());
        } else {
            $controllerName = "Septillion\\App\\Controllers\\".$controller;
            $controllerObject = new $controllerName();
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if (!empty(self::$routerParameteres)) {
                        $controllerAction = 'show';
                        Controller::exe($controllerObject, $controllerAction, Request::getInstance());
                    } else {
                        $controllerAction = 'index';
                        Controller::exe($controllerObject, $controllerAction, Request::getInstance());
                    }
                    break;
                case 'POST':
                    $controllerAction = 'store';
                    Controller::exe($controllerObject, $controllerAction, Request::getInstance());
                    break;
                case 'PUT':
                    //need to update the router for this to work
                    $controllerAction = 'update';
                    Controller::exe($controllerObject, $controllerAction, Request::getInstance());
                    break;
                case 'DELETE':
                    //need to update the router for this to work
                    $controllerAction = 'destroy';
                    Controller::exe($controllerObject, $controllerAction, Request::getInstance());
                    break;
            }
        }
    }

    private static function executingCallbackOrRunningControllerFunction($controller)
    {
        if (is_callable($controller)) {
            call_user_func($controller, Request::getInstance());
        } else {
            self::findingAndExecutingController($controller);
        }
    }

    public static function get($route, $controller)
    {
        if (self::isRouteMatch($route)) {
            if ($_SERVER['REQUEST_METHOD'] == 'GET') {
                self::executingCallbackOrRunningControllerFunction($controller);
            } else {
                echo 'Method Not Allowed';
            }
        }
    }

    public static function resource($route, $controller) 
    {
        if (self::isRouteMatch($route)) {
            self::executingCallbackOrRunningControllerFunction($controller);
        }
    }
}
