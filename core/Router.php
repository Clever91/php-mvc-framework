<?php

namespace app\core;

use app\core\interface\IRouter;
use app\core\Request;
use app\core\Response;

class Router implements IRouter
{
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

    public function match(array $methods, string $url, string|array|callable $handler): void
    {
        foreach ($methods as $method)
            $this->routers[strtolower($method)][$url] = $handler;
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
            $this->response->setStatusCode(500);
            return $this->renderView("error");
        }
        $handler = $this->routers[$method][$url] ?? false;
        if ($handler == false) {
            $this->response->setStatusCode(404);
            return $this->renderView("error");
        }
        if (is_string($handler)) {
            return $this->renderView($handler);
        } else if (is_array($handler)) {
            Application::$app->controller = new $handler[0];
            $handler[0] = Application::$app->controller;
        }
        return call_user_func($handler, $this->request, $this->response);
    }

    public function renderView(string $view, array $params = []): mixed
    {
        $layoutContent = $this->getLayout();
        $viewContent = $this->getView($view, $params);
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    private function getLayout(): string
    {
        $layout = Application::$app->controller?->layout ?? Application::$app->layout;
        ob_start();
        require_once Application::$ROOT_DIR . "/views/layouts/{$layout}.php";
        return ob_get_clean();
    }

    private function getView(string $view, array $params): string
    {
        foreach ($params as $key => $value)
            $$key = $value;
        ob_start();
        require_once Application::$ROOT_DIR . "/views/{$view}.php";
        return ob_get_clean();
    }
}
