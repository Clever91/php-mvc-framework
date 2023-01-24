<?php

namespace app\core\middleware;

use app\core\Application;
use app\core\exception\ForbiddenException;
use app\core\Middleware;

class AuthMiddleware extends Middleware
{
    public function execute(): void
    {
        if (Application::$app->isGuest()) {
            $action = Application::$app->controller->action;
            if (empty($this->actions) || in_array($action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}
