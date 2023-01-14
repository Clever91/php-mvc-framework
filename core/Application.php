<?php

namespace app\core;

use app\core\Router;
use app\core\Request;
use app\core\Response;

class Application
{
    public Database $db;
    public Router $router;
    public Controller $controller;
    public static Application $app;
    public static string $ROOT_DIR;

    public function __construct(string $rootDir, array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootDir;
        $this->router = new Router(new Request(), new Response());
        $this->db = new Database($config["db"]);
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }
}
