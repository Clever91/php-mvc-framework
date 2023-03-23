<?php

namespace app\models;

use cleveruz\phpmvc\UserIdentity;

class User extends UserIdentity
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

    public function encriptPassword(): void
    {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function validPassword(string $password): bool
    {
        return password_verify($password, $this->password);
        // return password_verify($this->password, password_hash($password, PASSWORD_BCRYPT));
    }

    public function displayName(): string
    {
        return $this->fullname;
    }
}
