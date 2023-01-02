<?php

namespace app\controllers;

use app\core\Controller;

class SiteController extends Controller
{

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

    public function handleContact()
    {
        return "Handling submited data";
    }
}
