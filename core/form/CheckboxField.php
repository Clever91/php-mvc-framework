<?php

namespace app\core\form;

use app\core\Field;

class CheckboxField extends Field
{
    public function mainContent(): string
    {
        $checked = $this->model->{$this->attribute} ? "checked" : "";
        return sprintf(
            '<input name="%s" type="%s" class="form-check-input %s" %s>',
            $this->attribute,
            self::TYPE_CHECKBOX,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $checked
        );
    }
}
