<?php

namespace app\core;

use app\core\Application;
use app\core\interface\IController;

class Controller implements IController
{
    public string $layout = "main";

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function render(string $view, array $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }

    public function redirect(string $url = '/'): void
    {
        header("Location: {$url}");
    }
}
