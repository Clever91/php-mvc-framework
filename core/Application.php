<?php

namespace app\core;

class Application
{
    public Router $router;
    public Request $request;

    public function __construct()
    {
        $this->router = new Router();
        $this->request = new Request();
        $this->router->useRequest($this->request);
    }

    public function run(): void
    {
        try {
            $this->router->resolve();
        } catch (\Throwable $th) {
            echo "<b>Code:</b> " . $th->getCode() . "<br>";
            echo "<b>Message:</b> " . $th->getMessage();
        }
    }
}
