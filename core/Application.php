<?php

namespace app\core;

use app\core\Router;
use app\core\Request;
use app\core\Response;

class Application
{
    public Router $router;
    public static Application $app;
    public static string $ROOT_DIR;

    public function __construct(string $rootDir)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootDir;
        $this->router = new Router(new Request(), new Response());
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }
}
