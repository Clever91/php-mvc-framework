<?php

namespace app\models;

use app\core\DbModel;

class User extends DbModel
{
    public string $fullname;
    public string $email;
    public string $username;
    public string $password;
    public string $confirmPassword;

    public function tableName(): string
    {
        return "users";
    }

    public function attributes(): array
    {
        return ["fullname", "email", "username", "password"];
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

    protected function beforeSave(): bool
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
        return parent::beforeSave();
    }

    public function primeryKey(): string
    {
        return "id";
    }

    public static function find(string $attribute, string $value)
    {
        return (new self)->findOne($attribute, $value);
    }
}
