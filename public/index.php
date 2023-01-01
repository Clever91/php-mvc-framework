<?php

require_once __DIR__ . "/../vendor/autoload.php";

use app\core\Application;

$app = new Application(dirname(__DIR__));
$app->router->get("/", "home");
$app->router->get("/about", "about");
$app->router->get("/contact", function () {
    return "Contact";
});
$app->run();
