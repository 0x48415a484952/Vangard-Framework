<?php


namespace Septillion\Framework\Middleware;


use Septillion\Framework\Request\Request;
use Septillion\Framework\Response\Response;

interface MiddlewareInterface
{
    public function __invoke(Request $request, Response $response, callable $next);
}