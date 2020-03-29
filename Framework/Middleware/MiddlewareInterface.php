<?php

declare(strict_types=1);

namespace Septillion\Framework\Middleware;

use Septillion\Framework\Request\Request;

interface MiddlewareInterface
{
    public function __invoke(Request $request, callable $next): Request;
}
