<?php

namespace app\core;

class Logger
{
    public static function dump(array|string|object $data): void
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit();
    }
}
