<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\middleware\AuthMiddleware;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddlewares([
            new AuthMiddleware(["profile"])
        ]);
    }

    public function home()
    {
        return $this->render("home", [
            "name" => "Welcome home page"
        ]);
    }

    public function contact()
    {
        return $this->render("contact");
    }

    public function handleContact(Request $request)
    {
        $postData = $request->getBody();
        if ($request->isPost()) {
            return "Handling submitted data";
        }
        return $this->render("contact");
    }

    public function profile(Request $request)
    {
        return $this->render("profile");
    }
}
