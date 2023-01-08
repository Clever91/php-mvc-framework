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

    public function textField(Model $model, string $attribute, string $label = null, array $option = [])
    {
        return new Field($model, $attribute, Field::TYPE_TEXT, $label, $option);
    }

    public function emailField(Model $model, string $attribute, string $label = null, array $option = [])
    {
        return new Field($model, $attribute, Field::TYPE_EMAIL, $label, $option);
    }

    public function passwordField(Model $model, string $attribute, string $label = null, array $option = [])
    {
        return new Field($model, $attribute, Field::TYPE_PASSWORD, $label, $option);
    }

    public function buttonField(string $name, string $label = null, array $option = [])
    {
        return new Button($name, Button::TYPE_BUTTON, $label, $option);
    }

    public function submitField(string $name, string $label = null, array $option = [])
    {
        return new Button($name, Button::TYPE_SUBMIT, $label, $option);
    }

    public static function end(): void
    {
        echo "</form>";
    }
}
