<?php

namespace app\core\form;

use app\core\Field;

class PasswordField extends Field
{
    public function mainContent(): string
    {
        return sprintf(
            '<input name="%s" type="%s" class="form-control %s" value="%s">',
            $this->attribute,
            self::TYPE_PASSWORD,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute}
        );
    }
}
