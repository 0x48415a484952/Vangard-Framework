<?php

declare(strict_types=1);

namespace Septillion\Framework\Middleware;


use Septillion\App\Configs\MiddlewareConfig;
use Septillion\Framework\Pipeline\Pipeline;
use Septillion\Framework\Request\Request;

class Middleware extends MiddlewareConfig
{
    protected array $_stack = MiddlewareConfig::MIDDLEWARE_STACK;

    public function run(Request $request): void
    {
        $stages = [];
        foreach ($this->_stack as $key => $middlewareName) {
           $stages[$key] = new $middlewareName();
        }

//        foreach ($stages as $stage) {
//            $stage($request);
//        }

        $pipeline = new Pipeline();
        $pipeline->setInput($request)->setStages($stages)->exe();
//        dd($pipeline);
    }
}
