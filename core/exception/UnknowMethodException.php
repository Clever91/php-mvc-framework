<?php

namespace app\core\exception;

use Exception;

class UnknowMethodException extends Exception
{
    protected $code = 410;
    protected $message = "Unknow method";
}
