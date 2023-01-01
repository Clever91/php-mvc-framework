<?php

namespace app\core;

use app\core\interface\ResponseInterface;

class Response implements ResponseInterface
{
    public function setCode(int $code): void
    {
        http_response_code($code);
    }
}
