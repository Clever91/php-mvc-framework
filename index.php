<?php

require_once "core\interface\RouterInterface.php";
require_once "core\interface\RequestInterface.php";
require_once "core\Application.php";
require_once "core\Router.php";
require_once "core\Request.php";

use app\core\Application;

$app = new Application();
$app->router->get("/", function () {
    return "Hello World !!!";
});
$app->router->get("/contact", function () {
    return "Contact";
});
$app->run();
