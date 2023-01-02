<?php

namespace app\core;

use app\core\interface\IRequest;

class Request implements IRequest
{
    public function getUrl(): string
    {
        $url = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($url, "?");
        if ($position === false) {
            return $url;
        }
        return substr($url, 0, $position);
    }

    public function getMethod(): string
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public function getBody(): array
    {
        $body = [];
        if ($this->isGet()) {
            foreach ($_GET as $key => $value)
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        } else if ($this->isPost()) {
            foreach ($_POST as $key => $value)
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $body;
    }

    public function isPost(): bool
    {
        return $this->getMethod() === "post";
    }

    public function isGet(): bool
    {
        return $this->getMethod() === "get";
    }
}
