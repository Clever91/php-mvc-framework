<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Logger;
use app\core\Request;
use app\models\Login;

class AuthController extends Controller
{
    public function signIn(Request $request)
    {
        $this->setLayout("auth");

        $model = new Login();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            // Logger::dump($model);
            if ($model->validate()) {
                return "success";
            }
        }

        return $this->render("sign-in", [
            "model" => $model
        ]);
    }
}
