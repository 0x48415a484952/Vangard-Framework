<?php


namespace Septillion\Framework\Middleware;


use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

class SecondMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, callable $next): MiddlewareInterface
    {
        echo 'second middleware';
    }
}