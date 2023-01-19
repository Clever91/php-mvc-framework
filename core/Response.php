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
}
