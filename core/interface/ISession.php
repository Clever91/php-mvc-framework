<?php

namespace app\core\interface;

interface ISession
{
    public function hasFlash(string $key): bool;
    public function getFlash(string $key): mixed;
    public function setFlash(string $key, string|array|bool $value): void;
    public function has(string $key): bool;
    public function set(string $key, string|int|array $value): void;
    public function get(string $key): mixed;
    public function remove(string $key): void;
}
