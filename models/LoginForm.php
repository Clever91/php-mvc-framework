<?php

namespace app\models;

use app\core\ModelForm;

class LoginForm extends ModelForm
{
    public string $username;
    public string $password;
    public bool $remenberMe = true;

    /**
     * @desc if you don't add remenberMe attribute, you must initial it
     * */ 
    public function rules(): array
    {
        return [
            "username" => [self::RULE_REQUIRED],
            "password" => [self::RULE_REQUIRED],
        ];
    }

    public function login(): bool
    {
        return false;
    }
}
