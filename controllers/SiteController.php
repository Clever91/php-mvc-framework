<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\middleware\AuthMiddleware;
use app\core\Response;
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
