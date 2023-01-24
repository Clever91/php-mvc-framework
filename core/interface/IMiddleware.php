<?php

namespace app\core\interface;

interface IMiddleware
{
    public function execute(): void;
}
