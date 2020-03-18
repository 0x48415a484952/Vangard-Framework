<?php

namespace Septillion\Framework\Router;

use Septillion\Framework\Request\Request;
use Septillion\Framework\Controller\Controller;

class Router
{
    private static $routerParameteres = [];

    public function __construct()
    {

    }

    private static function isRouteMatch($route)
    {
        $explodedRoute = explode('/', $route);
        $request = Request::getInstance();
        /// the below lines are for creating resources as well as automatic show method in a controller
        // if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($explodedRoute) + 1 == count($request->uriParts)) {
        //     array_push($explodedRoute, ':id');
        // }
        if (count($request->uriParts) != count($explodedRoute)) return false;
        foreach ($explodedRoute as $key => $value) {
            if (!array_key_exists($key, $request->uriParts)) return false;
            if (preg_match('/^:/', $value)) {
                $trimedValue = substr($value, 1);
                self::$routerParameteres[$trimedValue] = $request->uriParts[$key];
            } elseif ($value != $request->uriParts[$key]) return false;
        }
        if (count(self::$routerParameteres)) $request->params->set(self::$routerParameteres);
        ////demo
            Request::setPostBodyParams();
        ////end of demo
        return true;
    }

    private static function finalCall($route, $controller, $method = null)
    {
        if ($method != null && self::isRouteMatch($route) && $_SERVER['REQUEST_METHOD'] == $method) {
            Controller::executingCallbackOrRunningControllerAction($controller);
        } 

        //this line is for when user is using resource
        if ($method == null && self::isRouteMatch($route)) {
            Controller::executingCallbackOrRunningControllerAction($controller);
        }
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
