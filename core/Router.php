<?php

namespace app\core;

use app\core\interface\RouterInterface;
use app\core\Request;
use app\core\Response;
use Exception;

class Router implements RouterInterface
{
    public string $layout = "main";

    private array $routers = [];
    private Request $request;
    private Response $response;

    public function __construct(Request $resquest, Response $response)
    {
        $this->request = $resquest;
        $this->response = $response;
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
            $this->response->setCode(500);
            return $this->renderView("error");
        }
        $handler = $this->routers[$method][$url] ?? false;
        if ($handler == false) {
            $this->response->setCode(404);
            return $this->renderView("error");
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
