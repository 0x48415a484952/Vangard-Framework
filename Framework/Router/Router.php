<?php

declare(strict_types=1);

namespace Septillion\Framework\Router;

use Septillion\Framework\Request\Request;
use Septillion\Framework\Controller\Controller;

class Router
{
    private static array $routerParameters = [];

    public function __construct()
    {

    }

    private static function isRouteMatch(string $route) : bool
    {
        $explodedRoute = explode('/', $route);
        $request = Request::getInstance();
        /// the below lines are for creating resources as well as automatic show method in a controller
        // if ($_SERVER['REQUEST_METHOD'] == 'GET' && count($explodedRoute) + 1 == count($request->uriParts)) {
        //     array_push($explodedRoute, ':id');
        // }
        if (count($request->uriParts) !== count($explodedRoute)) {
            return false;
        }
        foreach ($explodedRoute as $key => $value) {
            if (!array_key_exists($key, $request->uriParts)) {
                return false;
            }
            if (preg_match('/^:/', $value)) {
                $trimmedValue = substr($value, 1);
                self::$routerParameters[$trimmedValue] = $request->uriParts[$key];
            } elseif ($value !== $request->uriParts[$key]) {
                return false;
            }
        }
        if (count(self::$routerParameters)) {
            $request->params->set(self::$routerParameters);
        }
        ////demo
            Request::setPostBodyParams();
        ////end of demo
        return true;
    }

    private static function finalCall(string $route, $controller, string $method = null) : void
    {
        if ($method !== null && $_SERVER['REQUEST_METHOD'] === $method && self::isRouteMatch($route)) {
            Controller::executingCallbackOrRunningControllerAction($controller);
        }

        //this line is for when user is using resource
        if ($method === null && self::isRouteMatch($route)) {
            Controller::executingCallbackOrRunningControllerAction($controller);
        }
    }

    public static function get(string $route, $controller) : void
    {
        self::finalCall($route, $controller, 'GET');
    }

    public static function post(string $route, $controller) : void 
    {
        self::finalCall($route, $controller, 'POST');
    }

    public static function put(string $route, $controller) : void
    {
        self::finalCall($route, $controller, 'PUT');
    }

    public static function delete(string $route, $controller) : void
    {
        self::finalCall($route, $controller, 'DELETE');
    }

    public static function resource(string $route, $controller) : void
    {
        self::finalCall($route, $controller);
    }
}
