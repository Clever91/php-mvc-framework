<?php

namespace app\core\interface;

interface IController
{
    public function render(string $view, array $params = []): string;
    public function redirect(string $url = '/'): void;
}
