<?php

namespace app\models;

use app\core\Model;

class Login extends Model
{
    public string $username;
    public string $password;
    public bool $remenberMe = true;

    public function attributes(): array
    {
        return [
            "username" => "string",
            "password" => "string",
            "remenberMe" => "bool",
        ];
    }

    public function rules(): array
    {
        return [
            "username" => [self::RULE_REQUIRED],
            "password" => [self::RULE_REQUIRED],
        ];
    }
}