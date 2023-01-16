<?php

namespace app\models;

use app\core\Model;

class Login extends Model
{
    public string $username;
    public string $password;
    public bool $remenberMe = true;

    public function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return ["username", "password", "remenberMe"];
    }

    public function rules(): array
    {
        return [
            "username" => [self::RULE_REQUIRED],
            "password" => [self::RULE_REQUIRED],
        ];
    }
}
