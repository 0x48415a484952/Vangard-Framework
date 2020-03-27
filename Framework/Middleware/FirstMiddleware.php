<?php


namespace Septillion\Framework\Middleware;


use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

class FirstMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, callable $next): MiddlewareInterface
    {
        echo 'first middleware';
    }
}