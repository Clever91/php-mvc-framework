<?php

namespace app\core;

class Application
{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->router = new Router(new Request());
    }

    public function run(): void
    {
        echo $this->router->resolve();
    }
}
