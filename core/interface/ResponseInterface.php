<?php

namespace app\core\interface;

interface ResponseInterface
{
    public function setStatusCode(int $code): void;
}
