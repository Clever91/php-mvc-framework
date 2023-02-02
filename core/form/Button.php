<?php

namespace app\core\form;

class Button
{
    public const TYPE_BUTTON = 'button';
    public const TYPE_SUBMIT = 'submit';

    protected string $name;
    protected string $label;
    protected string $type;

    public function __construct(string $name, string $type, string $label)
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
    }

    public function __toString(): string
    {
        return sprintf(
            '<button class="form-control btn btn-primary" name="%s" type="%s">%s</button>',
            $this->name,
            $this->type,
            $this->label
        );
    }
}
