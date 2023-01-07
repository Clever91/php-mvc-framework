<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';

    private Model $model;
    private string $attribute;
    private string $type;
    private string $label;
    private array $option = [];

    public function __construct(Model $model, string $attribute, string $type, string $label, array $option = [])
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->type = $type;
        $this->label = $label;
        $this->option = $option;
    }

    public function __toString(): string
    {
        return sprintf(
            '
        <label class="form-label">%s</label>
        <input name="%s" type="%s" class="form-control %s" value="%s">
        <small class="text-danger">%s</small>',
            $this->label,
            $this->attribute,
            $this->type,
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $this->model->{$this->attribute},
            $this->model->getFirstError($this->attribute)
        );
    }
}
