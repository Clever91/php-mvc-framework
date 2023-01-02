<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class RegisterController extends Controller
{
    public function signUp(Request $request)
    {
        if ($request->isPost())
            return "Handling register data";
        return $this->render("sign-up");
    }
}
