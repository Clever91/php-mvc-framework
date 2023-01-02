<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

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

    public function handleContact(Request $request)
    {
        $postData = $request->getBody();
        if ($request->isPost()) {
            echo "<pre>";
            var_dump($postData);
            echo "</pre>";
            return "Handling submitted data";
        }
        return $this->render("contact");
    }
}
