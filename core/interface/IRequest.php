<?php

namespace app\core\interface;

interface IRequest
{
    public function getUrl(): string;
    public function getMethod(): string;
    public function getBody(): array;
}