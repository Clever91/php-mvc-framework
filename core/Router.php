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
            return Application::$app->view->renderView($handler);
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

    public function getResponse()
    {
        return $this->response;
    }
}
