<?php

declare(strict_types=1);

namespace Septillion\Framework\Pipeline;

use Closure;

class Pipeline
{
    private $_input;
    private array $_stages;

    public function exe()
    {
        return call_user_func(
            array_reduce($this->_stages, $this->createStageCallback(), static function ($input) {
                return $input;
            }),
            $this->_input
        );
    }

    public function setInput($input): self
    {
        $this->_input = $input;
        return $this;
    }

    public function setStages(array $stages): self
    {
        $this->_stages = array_reverse($stages);
        return $this;
    }

    private function createStageCallback(): Closure
    {
        return static function ($stages, $stage) {
            return static function ($input) use ($stages, $stage) {
                return $stage($input, $stages);
            };
        };
    }
}
