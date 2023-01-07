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

    public static function end(): void
    {
        echo "</form>";
    }
}
