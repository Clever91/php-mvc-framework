<?php

namespace app\core;

use app\core\Application;
use app\core\interface\IController;

class Controller implements IController
{
    public function render(string $view, array $params = []): string
    {
        return Application::$app->router->renderView($view, $params);
    }
}
