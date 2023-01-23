<?php

namespace app\models;

use app\core\Application;
use app\core\DbModel;

class LoginForm extends DbModel
{
    public string $username;
    public string $password;
    public bool $rememberMe = true;

    public function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return ["username", "password"];
    }

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
        if ($model->validPassword($this->password)) {
            $key = Application::$app->config["identity"]["key"];
            Application::$app->session->set($key, $model->{$model->primaryKey()});
            return true;
        }
        return false;
    }
}
