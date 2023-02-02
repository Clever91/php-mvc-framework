<?php

namespace app\core\form;

use app\core\Model;

class Form
{
    public static function begin($action = '', $method = 'get'): Form
    {
        echo sprintf('<form action="%s" method="%s">', $action, $method);
        return new Form();
    }

    public function textField(Model $model, string $attribute, string $label = null)
    {
        return new TextField($model, $attribute, $label);
    }

    public function emailField(Model $model, string $attribute, string $label = null)
    {
        return new EmailField($model, $attribute, $label);
    }

    public function passwordField(Model $model, string $attribute, string $label = null)
    {
        return new PasswordField($model, $attribute, $label);
    }

    public function checkboxField(Model $model, string $attribute, string $label = null)
    {
        return new CheckboxField($model, $attribute, $label);
    }

    public function buttonField(string $attribute, string $label = null)
    {
        return new Button($attribute, Button::TYPE_BUTTON, $label);
    }

    public function submitField(string $name, string $label = null)
    {
        return new Button($name, Button::TYPE_SUBMIT, $label);
    }

    public function textareaField(Model $model, string $attribute, string $label)
    {
        return new TextareaField($model, $attribute, $label);
    }

    public static function end(): void
    {
        echo "</form>";
    }
}
