<?php

namespace app\controllers;

use cleveruz\phpmvc\Application;
use cleveruz\phpmvc\Controller;
use cleveruz\phpmvc\Request;
use cleveruz\phpmvc\Response;
use app\models\LoginForm;

class AuthController extends Controller
{
    public function signIn(Request $request, Response $response)
    {
        $this->setLayout("auth");

        $model = new LoginForm();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->login()) {
                $response->redirect("/");
            }
        }

        return $this->render("sign-in", [
            "model" => $model
        ]);
    }

    public function logout(Request $request)
    {
        Application::$app->session->remove("userId");
        $this->redirect('/');
    }
}
