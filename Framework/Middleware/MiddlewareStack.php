<?php


namespace Septillion\Framework\Middleware;


use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

class MiddlewareStack
{
    protected array $_stack = [
        FirstMiddleware::class,
        SecondMiddleware::class
    ];
}