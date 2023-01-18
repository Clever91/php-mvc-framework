<?php

namespace app\core;

use app\core\interface\ISession;

class Session implements ISession
{
    private const KEY_FLASH = "flash_messages";

    public function __construct()
    {
        session_start();
        if (empty($_SESSION[self::KEY_FLASH])) {
            $_SESSION[self::KEY_FLASH] = [];
        }
        foreach ($_SESSION[self::KEY_FLASH] as $key => &$flash) {
            if (isset($flash["removeable"]))
                $flash["removeable"] = true;
        }
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

    public function __destruct()
    {
        foreach ($_SESSION[self::KEY_FLASH] as $flash) {
            if (isset($flash["removeable"]) && $flash["removeable"])
                unset($_SESSION[self::KEY_FLASH]);
        }
    }
}
