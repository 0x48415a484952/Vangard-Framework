<?php

namespace Septillion\Framework\Router;

use Septillion\Framework\Request\Request;
use Septillion\Framework\Controller\Controller;

class Router
{
    private static $routerParameteres = [];
    private static $controllerRegex = '/[a-zA-Z]+([0-9]+)?[a-zA-Z]+@[a-zA-Z0-9]+/';
    private static $controllerNamespace = "Septillion\\App\\Controllers\\";
    private static $controllerObject;
    private static $controllerAction;

    public function __construct()
    {

    }

    private static function checkController($controller) 
    {       
        if (!preg_match(self::$controllerRegex, $controller)) {
            $controllerName = self::$controllerNamespace.$controller;
            self::$controllerObject = new $controllerName();
            return false;
        } 
        $explodedController = explode('@', $controller);
        $controllerName = self::$controllerNamespace.$explodedController[0];
        self::$controllerObject = new $controllerName();
        self::$controllerAction = $explodedController[1];
        return true;
    }

    private static function isRouteMatch($route)
    {
        $explodedRoute = explode('/', $route);
        $request = Request::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($explodedRoute) + 1 == count($request->uriParts)) {
            array_push($explodedRoute, ':id');
        }
        if (count($request->uriParts) != count($explodedRoute)) return false;
        foreach ($explodedRoute as $key => $value) {
            if (!array_key_exists($key, $request->uriParts)) return false;
            if (preg_match('/^:/', $value)) {
                $trimedValue = substr($value, 1);
                self::$routerParameteres[$trimedValue] = $request->uriParts[$key];
                self::$routerParameteres[$trimedValue] = $request->uriParts[$key];
            } elseif ($value != $request->uriParts[$key]) return false;
        }
        if (count(self::$routerParameteres)) $request->params->set(self::$routerParameteres);
        return true;
    }

    private static function executingController($methodName)
    {
        Controller::exe(self::$controllerObject, $methodName, Request::getInstance());
    }

    private static function executingControllerBasedOnMethod($controller)
    {
        if (self::checkController($controller)) {
            self::executingController(self::$controllerAction);
        } else {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if (!empty(self::$routerParameteres)) {
                        self::executingController('show');
                    } else {
                        self::executingController('index');
                    }
                    break;
                case 'POST':
                    self::executingController('store');
                    break;
                case 'PUT':
                    self::executingController('update');
                    break;
                case 'DELETE':
                    self::executingController('destroy');
                    break;
            }
        }
    }

    private static function executingCallbackOrRunningControllerMethod($controller)
    {
        if (is_callable($controller)) {
            call_user_func($controller, Request::getInstance());
        } else {
            self::executingControllerBasedOnMethod($controller);
        }
    }

    private static function finalCall($route, $controller, $method = null)
    {
        if ($method != null && self::isRouteMatch($route) && $_SERVER['REQUEST_METHOD'] == $method) {
            self::executingCallbackOrRunningControllerMethod($controller);
        } 

        if ($method == null && self::isRouteMatch($route)) self::executingCallbackOrRunningControllerMethod($controller);
    }

    public static function get($route, $controller)
    {
        self::finalCall($route, $controller, 'GET');
    }

    public static function post($route, $controller)
    {
        self::finalCall($route, $controller, 'POST');
    }

    public static function put($route, $controller)
    {
        self::finalCall($route, $controller, 'PUT');
    }

    public static function delete($route, $controller)
    {
        self::finalCall($route, $controller, 'DELETE');
    }

    public static function resource($route, $controller) 
    {
        self::finalCall($route, $controller);
    }
}
