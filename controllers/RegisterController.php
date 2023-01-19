<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
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
                return $this->redirect("/");
            }
        }

        return $this->render("sign-up", [
            "model" => $model
        ]);
    }
}
