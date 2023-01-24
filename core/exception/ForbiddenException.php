<?php

namespace app\core\exception;

use Exception;

class ForbiddenException extends Exception
{
    protected $code = 403;
    protected $message = "You don't have permission";
}
