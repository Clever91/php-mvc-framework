<?php

namespace app\core\interface;

interface ISession
{
    public function hasFlash(string $key): bool;
    public function getFlash(string $key): mixed;
    public function setFlash(string $key, string|array|bool $value): void;
}
