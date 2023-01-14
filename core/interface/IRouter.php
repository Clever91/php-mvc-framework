<?php

namespace app\core\interface;

interface IRouter
{
    public function get(string $url, string|array|callable $handler): void;
    public function post(string $url, string|array|callable $handler): void;
}