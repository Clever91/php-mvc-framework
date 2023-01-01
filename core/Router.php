<?php

namespace app\core;

use app\core\interface\RouterInterface;
use Exception;

class Router implements RouterInterface
{
    public string $layout = "main";

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

    private function renderView(string $view): mixed
    {
        $layoutContent = $this->getLayout();
        $viewContent = $this->getView($view);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    private function getLayout(): string
    {
        ob_start();
        require_once Application::$ROOT_DIR . "/views/layouts/{$this->layout}.php";
        return ob_get_clean();
    }

    private function getView(string $view): string
    {
        ob_start();
        require_once Application::$ROOT_DIR . "/views/{$view}.php";
        return ob_get_clean();
    }
}
