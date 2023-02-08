<?php

namespace app\controllers;

use cleveruz\phpmvc\Application;
use cleveruz\phpmvc\Controller;
use cleveruz\phpmvc\Request;
use cleveruz\phpmvc\middleware\AuthMiddleware;
use cleveruz\phpmvc\Response;
use app\models\ContactForm;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->registerMiddlewares([
            new AuthMiddleware(["profile"])
        ]);
    }

    public function home()
    {
        return $this->render("home", [
            "name" => "Welcome home page"
        ]);
    }

    public function contact(Request $request, Response $response)
    {
        $model = new ContactForm();
        if ($request->isPost()) {
            $model->loadData($request->getBody());
            if ($model->validate() && $model->send()) {
                Application::$app->session->setFlash("success", "Your message has send successfully");
                $response->redirect('/');
            }
        }
        return $this->render("contact", [
            'model' => $model
        ]);
    }

    public function profile(Request $request)
    {
        return $this->render("profile");
    }
}
