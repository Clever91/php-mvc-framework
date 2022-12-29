<?php

namespace app\core;

use app\core\interface\RequestInterface;

class Request implements RequestInterface
{
    public function getUrl(): string
    {
        $url = $_SERVER["REQUEST_URI"] ?? '/';
        $position = strpos($url, "?");
        if ($position === false) {
            return $url;
        }
        return substr($url, $position);
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
