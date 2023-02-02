<?php
// display error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// autoload
require_once __DIR__ . "/../vendor/autoload.php";

use app\controllers\AuthController;
use app\controllers\RegisterController;
use app\controllers\SiteController;
use app\core\Application;
use app\models\User;

// enviroment
$dirname = dirname(__DIR__);
$dotenv = Dotenv\Dotenv::createImmutable($dirname);
$dotenv->load();

// load application
$app = new Application($dirname, [
    "identity" => [
        "class" => User::class,
    ],
    "db" => [
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
]);
// routes
$app->router->get("/", [SiteController::class, "home"]);
$app->router->get("/about", "about");
$app->router->get("/contact", [SiteController::class, "contact"]);
$app->router->post("/contact", [SiteController::class, "handleContact"]);
$app->router->get("/welcome", function () {
    return Application::$app->view->renderView("welcome", ["name" => "Sherzod"]);
});
$app->router->match(["get", "post"], "/signUp", [RegisterController::class, "signUp"]);
$app->router->match(["get", "post"], "/signIn", [AuthController::class, "signIn"]);
$app->router->match(["get", "post"], "/logout", [AuthController::class, "logout"]);
$app->router->get("/profile", [SiteController::class, "profile"]);
// run 
$app->run();
