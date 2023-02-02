<?php

namespace app\core\form;

use app\core\Field;

class TextField extends Field
{
    public function mainContent(): string
    {
        return sprintf(
            '<input name="%s" type="%s" class="form-control %s" value="%s">',
            $this->attribute,
            self::TYPE_TEXT,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute}
        );
    }
}
