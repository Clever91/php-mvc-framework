<?php

namespace app\core\interface;

interface IModel
{
    public function loadData(array $data): void;
    public function validate(): bool;
    public function rules(): array;
    public function attributes(): array;
    public function getErrors(): array;
}
