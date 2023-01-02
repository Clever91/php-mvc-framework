<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        if ($request->isPost())
            return "Handling auth data";
        return $this->render("sign-in");
    }
}
