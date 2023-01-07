<?php

namespace app\core;

use app\core\interface\IModel;

abstract class Model implements IModel
{
    public const RULE_REQUIRED = "required";
    public const RULE_EMAIL = "email";
    public const RULE_MIN = "min";
    public const RULE_MAX = "max";
    public const RULE_MATCH = "match";

    private array $errors = [];

    public function __construct()
    {
        foreach ($this->attributes() as $property => $type) {
            if ($type == "string")
                $this->{$property} = '';
        }
    }

    public function loadData(array $data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->{$attribute};
            foreach ($rules as $rule) {
                $ruleName = $rule;
                if (is_array($rule)) {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && empty($value)) {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule["min"]) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule["max"]) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule["match"]}) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasError(string $attribute): bool
    {
        return isset($this->errors[$attribute]) ? true : false;
    }

    public function getFirstError(string $attribute): string
    {
        if ($this->hasError($attribute))
            return $this->errors[$attribute][0];
        return "";
    }

    private function addError(string $attribute, string $rule, array $params = []): void
    {
        $message = $this->getErrorMessage($rule);
        foreach ($params as $key => $label) {
            if (is_string($key)) {
                $message = str_replace("{{$key}}", $label, $message);
            }
        }
        $this->errors[$attribute][] = $message;
    }

    private function getErrorMessage(string $rule): string
    {
        return match ($rule) {
            self::RULE_REQUIRED => "This field is required",
            self::RULE_EMAIL => "This field is not email format",
            self::RULE_MIN => "The lenght must not be less then {min} charaters",
            self::RULE_MAX => "The lenght must not be more then {max} charaters",
            self::RULE_MATCH => "The field must be the same as {match} field",
            default => "The given rule is invalid"
        };
    }
}
