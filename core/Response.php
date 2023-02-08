<?php

namespace app\core;

use app\core\interface\IResponse;

class Response implements IResponse
{
    public function setStatusCode(int $code): void
    {
        http_response_code($code);
    }

    public function redirect(string $url = '/'): void
    {
        header("Location: {$url}");
    }

    public function render(string $view, array $params): string
    {
        return Application::$app->view->renderView($view, $params);
    }
}
