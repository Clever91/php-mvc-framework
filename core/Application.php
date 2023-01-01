<?php

namespace app\core;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;

    public function __construct(string $rootDir)
    {
        self::$ROOT_DIR = $rootDir;
        $this->router = new Router(new Request());
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }
}
