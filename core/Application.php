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
    public Session $session;
    public ?UserIdentity $user;
    public static Application $app;
    public static string $ROOT_DIR;
    public array $config;
    public string $layout = "main";

    public function __construct(string $rootDir, array $config)
    {
        self::$app = $this;
        self::$ROOT_DIR = $rootDir;
        $this->router = new Router(new Request(), new Response());
        $this->db = new Database($config["db"]);
        $this->session = new Session();
        $this->config = $config;
        if ($this->session->has("userId")) {
            $this->user = $config["identity"]["class"]::find("id", $this->session->get("userId"));
        } else {
            $this->user = null;
        }
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }

    public function isGuest(): bool
    {
        return is_null($this->user);
    }

    public function login(UserIdentity $user)
    {
        $this->user = $user;
        $this->session->set("userId", $user->{$user->primaryKey()});
        return true;
    }
}
