<?php

namespace Septillion\Framework\Router;

use Septillion\Framework\Request\Request;
use Septillion\Framework\Controller\Controller;

class Router
{
    private static $route;
    private static $routerParameteres = [];
    private static $explodedRoute;
    private static $controllerRegex = '/[a-zA-Z]+([0-9]+)?[a-zA-Z]+@[a-zA-Z0-9]+/';
    private static $controllerNamespace = "Septillion\\App\\Controllers\\";
    private static $controllerObject;
    private static $controllerAction;

    public function __construct()
    {
        
    }

    private static function setRoute($route)
    {
        self::$route = $route;
    }

    private static function getRoute()
    {
        return self::$route;
    }

    private static function setExplodedRoute()
    {
        self::$explodedRoute = explode('/', self::$route);
    }

    private static function checkAction($actionName)
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
        self::setRoute($route);
        self::setExplodedRoute();
        $request = Request::getInstance();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (count(self::$explodedRoute) + 1 == count($request->uriParts)) {
                array_push(self::$explodedRoute, ':id');
            }
        }
        if (count($request->uriParts) != count(self::$explodedRoute)) return false;
        foreach (self::$explodedRoute as $key => $value) {
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

    private static function findingAndExecutingController($controller)
    {
        if (self::checkController($controller)) {
            Controller::exe(self::$controllerObject, self::$controllerAction, Request::getInstance());
        } else {
            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if (!empty(self::$routerParameteres)) {
                        Controller::exe(self::$controllerObject, 'show', Request::getInstance());
                    } else {
                        Controller::exe(self::$controllerObject, 'index', Request::getInstance());
                    }
                    break;
                case 'POST':
                    Controller::exe(self::$controllerObject, 'store', Request::getInstance());
                    break;
                case 'PUT':
                    Controller::exe(self::$controllerObject, 'update', Request::getInstance());
                    break;
                case 'DELETE':
                    Controller::exe(self::$controllerObject, 'destroy', Request::getInstance());
                    break;
            }
        }
    }

    private static function executingCallbackOrRunningControllerMethod($controller)
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
                self::executingCallbackOrRunningControllerMethod($controller);
            } else {
                echo 'Method Not Allowed';
            }
        }
    }

    public static function post($route, $controller)
    {
        if (self::isRouteMatch($route)) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                self::executingCallbackOrRunningControllerMethod($controller);
            } else {
                echo 'Method Not Allowed';
            }
        }
    }

    public static function put($route, $controller)
    {
        if (self::isRouteMatch($route)) {
            if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
                self::executingCallbackOrRunningControllerMethod($controller);
            } else {
                echo 'Method Not Allowed';
            }
        }
    }

    public static function delete($route, $controller)
    {
        if (self::isRouteMatch($route)) {
            if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
                self::executingCallbackOrRunningControllerMethod($controller);
            } else {
                echo 'Method Not Allowed';
            }
        }
    }

    public static function resource($route, $controller) 
    {
        if (self::isRouteMatch($route)) {
            self::executingCallbackOrRunningControllerMethod($controller);
        }
    }
}
