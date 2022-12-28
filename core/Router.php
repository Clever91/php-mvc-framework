<?php

namespace app\core;

use app\core\interface\RouterInterface;

class Router implements RouterInterface
{
    private array $routers = [];

    public function get(string $url, string|array|callable $handler): void
    {
        $this->routers["get"][$url] = $handler;
    }

    public function post(string $url, string|array|callable $handler): void
    {
        $this->routers["post"][$url] = $handler;
    }

    public function resolve()
    {
        echo "<pre>";
        echo var_dump($_SERVER);
        echo "</pre>";
        die;
    }
}
