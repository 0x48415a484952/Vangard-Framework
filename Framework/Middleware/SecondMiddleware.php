<?php

declare(strict_types=1);

namespace Septillion\Framework\Middleware;

use Septillion\Framework\Request\Request;

class SecondMiddleware implements MiddlewareInterface
{
    public function __invoke(Request $request, callable $next): Request
    {
        $request->params->setItem('secondMiddleware', '2');
        return $next($request);
    }
}
