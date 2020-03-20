<?php

declare(strict_types=1);

namespace Septillion\Framework\Controller;

use Septillion\Framework\Request\Request;

class Controller
{
    const CONTROLLER_REGEX = '/[a-zA-Z]+([0-9]+)?[a-zA-Z]+@[a-zA-Z0-9]+/';
    const USERS_CONTROLLER_NAMESPACE = "Septillion\\App\\Controllers\\";
    private static Controller $controllerObject;
    private static string $controllerAction;

    public static function exe(Controller $controllerObject, string $controllerAction, Request $request)
    {
        if ($controllerObject) {
            return call_user_func([$controllerObject, $controllerAction], $request);
        } else {
            echo 'controller not defined';
        }
        
    }

    private static function checkController(string $controller) : bool
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

    private static function callingExeMethodWithSameObjectButDifferentAction(string $controllerAction) : void
    {
        self::exe(self::$controllerObject, $controllerAction, Request::getInstance());
    }

    private static function checkingIfControllerIsDefinedAsResourceOrControllerAndAction(string $controller) : void
    {
        if (self::checkController($controller)) {
            self::callingExeMethodWithSameObjectButDifferentAction(self::$controllerAction);
        } else {
            switch (strtoupper($_SERVER['REQUEST_METHOD'])) {
                case 'GET':
                    // if (!empty(self::$routerParameters)) {
                    //     self::callingExeMethodWithSameObjectButDifferentAction('show');
                    // } else {
                    //     self::callingExeMethodWithSameObjectButDifferentAction('index');
                    // }
                    self::callingExeMethodWithSameObjectButDifferentAction('index');
                    break;
                case 'POST':
                    self::callingExeMethodWithSameObjectButDifferentAction('store');
                    break;
                case 'PUT':
                    self::callingExeMethodWithSameObjectButDifferentAction('update');
                    break;
                case 'DELETE':
                    self::callingExeMethodWithSameObjectButDifferentAction('destroy');
                    break;
            }
        }
    }

    public static function executingCallbackOrRunningControllerAction($controller) : void
    {
        if (is_callable($controller)) {
            call_user_func($controller, Request::getInstance());
        } else {
            self::checkingIfControllerIsDefinedAsResourceOrControllerAndAction($controller);
        }
    }
}