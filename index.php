<?php

require_once "core\interface\RouterInterface.php";
require_once "core\Application.php";
require_once "core\Router.php";

use app\core\Application;

$app = new Application();
$app->router->get("/", function () {
    return "Hello World !!!";
});
$app->router->get("/contact", function () {
    return "Contact";
});
$app->run();
