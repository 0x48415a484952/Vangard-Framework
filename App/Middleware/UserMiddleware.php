<?php


namespace Septillion\App\Middleware;


use Septillion\Framework\Middleware\MiddlewareInterface;
use Septillion\Framework\Request\Request;

class UserMiddleware implements MiddlewareInterface
{

    public function __invoke(Request $request, callable $next): Request
    {
        $request->params->setItem('userMiddleware', 'this is a user middleware');
        return $next($request);
    }
}