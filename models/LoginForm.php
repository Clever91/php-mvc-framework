<?php

namespace app\models;

use cleveruz\phpmvc\Application;
use cleveruz\phpmvc\ModelForm;

class LoginForm extends ModelForm
{
    public string $username;
    public string $password;
    public bool $rememberMe = true;

    public function rules(): array
    {
        return [
            "username" => [self::RULE_REQUIRED],
            "password" => [self::RULE_REQUIRED],
        ];
    }

    public function login(): bool
    {
        $model = User::find('username', $this->username);
        if ($model && $model->validPassword($this->password)) {
            return Application::$app->login($model);
        } else {
            $this->addError("username", "Your username or password is incorrect");
            $this->addError("password", "Your username or password is incorrect");
        }
        return false;
    }
}
