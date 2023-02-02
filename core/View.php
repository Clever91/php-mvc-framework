<?php

namespace app\core;

class View
{
    public string $title;
    public string $description;

    public function renderView(string $view, array $params = []): mixed
    {
        $viewContent = $this->getView($view, $params);
        $layoutContent = $this->getLayout();
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
