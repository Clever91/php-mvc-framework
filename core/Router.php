<?php

namespace app\core;

use app\core\interface\IRouter;
use app\core\Request;
use app\core\Response;
use app\core\exception\NotFoundException;
use app\core\exception\UnknowMethodException;

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
            throw new UnknowMethodException();
        }
        $handler = $this->routers[$method][$url] ?? false;
        if ($handler == false) {
            throw new NotFoundException();
        }
        if (is_string($handler)) {
            return $this->renderView($handler);
        } else if (is_array($handler)) {
            $controller = new $handler[0];
            $controller->action = $handler[1];
            Application::$app->controller = $controller;
            $handler[0] = Application::$app->controller;
            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }
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

    public function getResponse()
    {
        return $this->response;
    }
}
