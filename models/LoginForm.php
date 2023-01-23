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
        if (password_verify($model->password, password_hash($this->password, PASSWORD_BCRYPT))) {
            Application::$app->session->set("userId", $model->{$model->primeryKey()});
            return true;
        }
        return false;
    }
}
