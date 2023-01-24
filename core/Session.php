<?php

namespace app\core;

use app\core\interface\ISession;

class Session implements ISession
{
    private const KEY_FLASH = "flash_messages";
    private const KEY_VARIABLE = "variables";

    public function __construct()
    {
        session_start();
        $this->initialDefault();
        $this->makeRemoveable();
    }

    public function hasFlash(string $key): bool
    {
        return isset($_SESSION[self::KEY_FLASH][$key]) ? true : false;
    }

    public function getFlash(string $key): mixed
    {
        return $_SESSION[self::KEY_FLASH][$key]["value"] ?? false;
    }

    public function setFlash(string $key, string|array|bool $value): void
    {
        $_SESSION[self::KEY_FLASH][$key]["removeable"] = false;
        $_SESSION[self::KEY_FLASH][$key]["value"] = $value;
    }

    public function has(string $key): bool
    {
        return isset($_SESSION[self::KEY_VARIABLE][$key]) ? true : false;
    }

    public function set(string $key, string|int|array $value): void
    {
        $_SESSION[self::KEY_VARIABLE][$key] = $value;
    }

    public function get(string $key): mixed
    {
        return $_SESSION[self::KEY_VARIABLE][$key] ?? false;
    }

    public function remove(string $key): void
    {
        unset($_SESSION[self::KEY_VARIABLE][$key]);
    }

    private function makeRemoveable()
    {
        foreach ($_SESSION[self::KEY_FLASH] as &$flash) {
            if (isset($flash["removeable"]))
                $flash["removeable"] = true;
        }
    }

    private function initialDefault()
    {
        if (empty($_SESSION[self::KEY_FLASH])) {
            $_SESSION[self::KEY_FLASH] = [];
        }
        if (empty($_SESSION[self::KEY_VARIABLE])) {
            $_SESSION[self::KEY_VARIABLE] = [];
        }
    }

    public function __destruct()
    {
        foreach ($_SESSION[self::KEY_FLASH] as $key => $flash) {
            if (isset($flash["removeable"]) && $flash["removeable"])
                unset($_SESSION[self::KEY_FLASH][$key]);
        }
    }
}
