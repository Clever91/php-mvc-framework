<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_CHECKBOX = 'checkbox';

    protected Model $model;
    protected string $attribute;
    protected string $type;
    protected string $label;
    protected array $option = [];

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
        $value = $this->model->{$this->attribute};
        if ($this->type == self::TYPE_CHECKBOX)
            $value = $value ? "true" : "false";
        return sprintf(
            '
        <label class="%s">%s</label>
        <input name="%s" type="%s" class="%s %s" value="%s" %s>
        <small class="text-danger">%s</small>',
            $this->option["labelClass"] ?? "",
            $this->label,
            $this->attribute,
            $this->type,
            $this->option["inputClass"] ?? "",
            $this->model->hasError($this->attribute) ? 'is-invalid' : '',
            $value,
            $this->type == self::TYPE_CHECKBOX ? 'checked="' . $value . '"' : '',
            $this->model->getFirstError($this->attribute)
        );
    }
}
