<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\RegisterController;
use app\controllers\SiteController;
use app\core\Application;

$app = new Application(dirname(__DIR__));
$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/about", "about");
$app->router->get("/contact", [SiteController::class, "contact"]);
$app->router->post("/contact", [SiteController::class, "handleContact"]);
$app->router->get("/welcome", function () {
    return Application::$app->router->renderView("welcome", ["name" => "Sherzod"]);
});
// auth and register
$app->router->match(["get", "post"], "/signUp", [RegisterController::class, "signUp"]);
$app->router->match(["get", "post"], "/signIn", [AuthController::class, "signIn"]);
// run application
$app->run();
