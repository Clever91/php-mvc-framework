<?php

namespace app\core\form;

class Button
{
    public const TYPE_BUTTON = 'button';
    public const TYPE_SUBMIT = 'submit';

    protected string $name;
    protected string $type;
    protected string $label;
    protected array $option = [];

    public function __construct(string $name, string $type, string $label, array $option = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->label = $label;
        $this->option = $option;
    }

    public function __toString(): string
    {
        return sprintf(
            '<button class="%s" name="%s" type="%s">%s</button>',
            $this->option["class"] ?? "",
            $this->name,
            $this->type,
            $this->label
        );
    }
}
