<?php

namespace app\core;

use app\core\interface\RouterInterface;
use Exception;

class Router implements RouterInterface
{
    private array $routers = [];
    private Request $request;

    public function useRequest(Request $request)
    {
        $this->request = $request;
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

    public function resolve()
    {
        $url = $this->request?->getUrl();
        $method = $this->request?->getMethod();
        if (!$method || !in_array($method, $this->allowedMethods())) {
            throw new Exception("Method is not found or not allowed");
        }
        $handler = $this->routers[$method][$url] ?? false;
        if ($handler == false) {
            throw new Exception("Page is not found", 404);
        }
        echo call_user_func($handler);
    }
}
