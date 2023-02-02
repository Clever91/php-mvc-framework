<?php

namespace app\models;

use app\core\ModelForm;

class ContactForm extends ModelForm
{
    public string $subject;
    public string $email;
    public string $body;

    public function rules(): array
    {
        return [
            "subject" => [self::RULE_REQUIRED],
            "email" => [self::RULE_REQUIRED, self::RULE_EMAIL],
            "body" => [self::RULE_NONE],
        ];
    }

    public function send(): bool
    {
        return true;
    }
}
