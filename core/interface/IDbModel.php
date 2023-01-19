<?php

namespace app\core\interface;

interface IDbModel
{
    public function attributes(): array;
    public function tableName(): string;
}