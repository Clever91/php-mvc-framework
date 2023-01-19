<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        $this->setLayout("auth");

        $model = new LoginForm();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->login()) {
                return "success";
            }
        }

        return $this->render("sign-in", [
            "model" => $model
        ]);
    }
}
