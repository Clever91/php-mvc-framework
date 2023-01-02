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
        return [];
    }
}
