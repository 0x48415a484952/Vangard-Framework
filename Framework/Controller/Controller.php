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
    
        if (!preg_match($controllerRegex, $controller)) {
            $controllerName = $controllerPath.$controller;
            self::$controllerObject = new $controllerName();
            return false;
        }

        $explodedController = explode('@', $controller);
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

            match(strtoupper($_SERVER['REQUEST_METHOD'])) {
                'GET' => self::callingExeMethodWithSameObjectButDifferentAction('index'),
                'POST' => self::callingExeMethodWithSameObjectButDifferentAction('store'),
                'PUT' => self::callingExeMethodWithSameObjectButDifferentAction('update'),
                'DELETE' => self::callingExeMethodWithSameObjectButDifferentAction('destroy')
            };
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
