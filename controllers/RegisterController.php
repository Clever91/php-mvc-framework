<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Logger;
use app\core\Request;
use app\models\Register;

class RegisterController extends Controller
{
    public string $layout = "auth";

    public function signUp(Request $request)
    {
        $model = new Register();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->register()) {
                return "success";
            }
        }

        return $this->render("sign-up", [
            "model" => $model
        ]);
    }
}
