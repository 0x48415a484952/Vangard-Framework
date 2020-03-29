<?php

declare(strict_types=1);

namespace Septillion\Framework\Middleware;

use Septillion\Framework\Request\Request;

class FirstMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, callable $next): Request
    {
        $request->params->setItem('firstMiddleware', '1');
//        return $request;
        return $next($request);
    }
}
