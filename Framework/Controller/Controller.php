<?php

declare(strict_types=1);

namespace Septillion\Framework\Controller;

use RuntimeException;
use Septillion\App\Configs\ControllerConfig;
use Septillion\Framework\Request\Request;

class Controller
{
    private static Controller $controllerObject;
    private static string $controllerAction;

    public static function exe(Controller $controllerObject, string $controllerAction, Request $request)
    {
        if ($controllerObject) {
            return $controllerObject->$controllerAction($request);
        }
        throw new RuntimeException('controller not defined');
    }

    private static function checkController(string $controller) : bool
    {       
        $controllerPath = getenv('CONTROLLERS_PATH');
        $controllerRegex = getenv('CONTROLLERS_REGEX');
        // if (!preg_match(ControllerConfig::CONTROLLER_REGEX, $controller)) {
        if (!preg_match($controllerRegex, $controller)) {
            // $controllerName = ControllerConfig::USERS_CONTROLLER_NAMESPACE.$controller;
            
            $controllerName = $controllerPath.$controller;
            self::$controllerObject = new $controllerName();
            return false;
        }

        $explodedController = explode('@', $controller);
        // $controllerName = ControllerConfig::USERS_CONTROLLER_NAMESPACE.$explodedController[0];
        $controllerName = $controllerPath.$explodedController[0];
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
            $controller(Request::getInstance());
        } else {
            self::checkingIfControllerIsDefinedAsResourceOrControllerAndAction($controller);
        }
    }
}
