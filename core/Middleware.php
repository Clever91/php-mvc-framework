<?php

namespace app\core;

use app\core\interface\IMiddleware;

abstract class Middleware implements IMiddleware
{
    protected array $actions;

    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }
}
