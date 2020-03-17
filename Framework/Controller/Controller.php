<?php

namespace Septillion\Framework\Controller;

use Septillion\Framework\Request\Request;

class Controller
{
    const CONTROLLER_REGEX = '/[a-zA-Z]+([0-9]+)?[a-zA-Z]+@[a-zA-Z0-9]+/';
    const USERS_CONTROLLER_NAMESPACE = "Septillion\\App\\Controllers\\";
    private static $controllerObject;
    private static $controllerAction;

    public static function exe($controllerObject, $controllerAction, $request)
    {
        if ($controllerObject) {
            return call_user_func([$controllerObject, $controllerAction], $request);
        } else {
            echo 'controller not defined';
        }
        
    }

    private static function checkController($controller) 
    {       
        if (!preg_match(Controller::CONTROLLER_REGEX, $controller)) {
            $controllerName = Controller::USERS_CONTROLLER_NAMESPACE.$controller;
            self::$controllerObject = new $controllerName();
            return false;
        } 
        $explodedController = explode('@', $controller);
        $controllerName = Controller::USERS_CONTROLLER_NAMESPACE.$explodedController[0];
        self::$controllerObject = new $controllerName();
        self::$controllerAction = $explodedController[1];
        return true;
    }

    private static function executingController($methodName)
    {
        Controller::exe(self::$controllerObject, $methodName, Request::getInstance());
    }

    private static function executingControllerBasedOnHttpMethod($controller)
    {
        if (self::checkController($controller)) {
            self::executingController(self::$controllerAction);
        } else {
            switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
                case 'GET':
                    // if (!empty(self::$routerParameteres)) {
                    //     self::executingController('show');
                    // } else {
                    //     self::executingController('index');
                    // }
                    self::executingController('index');
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

    public static function executingCallbackOrRunningControllerMethod($controller)
    {
        if (is_callable($controller)) {
            call_user_func($controller, Request::getInstance());
        } else {
            self::executingControllerBasedOnHttpMethod($controller);
        }
    }
}