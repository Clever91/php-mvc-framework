<?php

namespace app\core;

use app\core\Model;

abstract class Field
{
    public const TYPE_TEXT = 'text';
    public const TYPE_TEXTAREA = 'textarea';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_EMAIL = 'email';
    public const TYPE_CHECKBOX = 'checkbox';

    protected Model $model;
    protected string $attribute;
    protected string $label;

    abstract public function mainContent(): string;

    public function __construct(Model $model, string $attribute, string $label = null)
    {
        $this->model = $model;
        $this->attribute = $attribute;
        $this->label = $label ?? $attribute;
    }

    public function __toString(): string
    {
        return sprintf(
            '<label class="form-label">%s</label>
            %s
            <small class="text-danger">%s</small>',
            $this->label,
            $this->mainContent(),
            $this->model->getFirstError($this->attribute)
        );
    }
}
