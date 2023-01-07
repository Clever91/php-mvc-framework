<?php

namespace app\models;

use app\core\Model;

class Register extends Model
{
    public string $fullname;
    public string $email;
    public string $username;
    public string $password;
    public string $confirmPassword;

    public function attributes(): array
    {
        return [
            "fullname" => "string",
            "email" => "string",
            "username" => "string",
            "password" => "string",
            "confirmPassword" => "string",
        ];
    }

    public function rules(): array
    {
        return [
            "fullname" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "username" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 3]],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 3], [self::RULE_MAX, "max" => 32]],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]],
        ];
    }

    public function register(): bool
    {
        return true;
    }
}
