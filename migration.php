<?php
// display error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// autoload
require_once __DIR__ . "/vendor/autoload.php";

use cleveruz\phpmvc\Application;

// enviroment
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// load application
$app = new Application(__DIR__, [
    "db" => [
        "dsn" => $_ENV["DB_DSN"],
        "user" => $_ENV["DB_USER"],
        "password" => $_ENV["DB_PASSWORD"]
    ]
]);
$app->db->applyMigrations();
