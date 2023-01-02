<?php

namespace app\core\interface;

interface IResponse
{
    public function setStatusCode(int $code): void;
}
