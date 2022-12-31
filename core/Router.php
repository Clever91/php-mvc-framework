<?php

namespace app\core;

use app\core\interface\RouterInterface;
use Exception;

class Router implements RouterInterface
{
    private array $routers = [];
    private Request $request;

    public function __construct(Request $resquest)
    {
        $this->request = $resquest;
    }

    public function get(string $url, string|array|callable $handler): void
    {
        $this->routers["get"][$url] = $handler;
    }

    public function post(string $url, string|array|callable $handler): void
    {
        $this->routers["post"][$url] = $handler;
    }

    private function allowedMethods(): array
    {
        return ["get", "post", "put"];
    }

    public function resolve(): string
    {
        $url = $this->request?->getUrl();
        $method = $this->request?->getMethod();
        if (!$method || !in_array($method, $this->allowedMethods())) {
            throw new Exception("Method is not found or not allowed");
        }
        $handler = $this->routers[$method][$url] ?? false;
        if ($handler == false) {
            return "Page is not found";
        }
        if (is_string($handler)) {
            return $this->renderView($handler);
        }
        return call_user_func($handler);
    }

    private function renderView(string $view)
    {
        require_once(__DIR__ . "/../views/{$view}.php");
    }
}
