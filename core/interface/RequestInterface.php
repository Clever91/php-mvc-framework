<?php

namespace app\core\interface;

interface RequestInterface
{
    public function getUrl(): string;
    public function getMethod(): string;
    public function getBody(): array;
}
