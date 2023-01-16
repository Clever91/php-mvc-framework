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

    public static function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return ["fullname", "email", "username", "password", "confirmPassword"];
    }

    public function rules(): array
    {
        return [
            "fullname" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL, [self::RULE_UNIQUE, "class" => self::class, "attribute" => "email"]],
            "username" => [self::RULE_REQUIRED, self::RULE_UNIQUE, [self::RULE_MIN, "min" => 3]],
            "password" => [self::RULE_REQUIRED, [self::RULE_MIN, "min" => 3], [self::RULE_MAX, "max" => 32]],
            "confirmPassword" => [self::RULE_REQUIRED, [self::RULE_MATCH, "match" => "password"]],
        ];
    }

    public function register(): bool
    {
        return true;
    }
}
