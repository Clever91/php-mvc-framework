<?php

namespace app\controllers;

use app\core\Application;

class SiteController
{

    public static function home()
    {
        return Application::$app->router->renderView("home", [
            "name" => "Welcome home page"
        ]);
    }

    public static function contact()
    {
        // return $this->render();
        return Application::$app->router->renderView("contact");
    }

    public static function handleContact()
    {
        return "Handling submited data";
    }
}
