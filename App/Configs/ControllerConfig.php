<?php

declare(strict_types=1);

namespace Septillion\App\Configs;


class ControllerConfig
{
    protected const CONTROLLER_REGEX = '/[a-zA-Z]+(\d+)?[a-zA-Z]+@[a-zA-Z0-9]+/';
    protected const USERS_CONTROLLER_NAMESPACE = "Septillion\\App\\Controllers\\";
}
