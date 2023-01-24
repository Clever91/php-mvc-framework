<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
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
