<?php

namespace app\controllers;

use cleveruz\phpmvc\Application;
use cleveruz\phpmvc\Controller;
use cleveruz\phpmvc\Request;
use app\models\User;

class RegisterController extends Controller
{
    public string $layout = "auth";

    public function signUp(Request $request)
    {
        $model = new User();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->save()) {
                Application::$app->session->setFlash("success", "User has saved successfully");
                $this->redirect("/");
            }
        }

        return $this->render("sign-up", [
            "model" => $model
        ]);
    }
}
