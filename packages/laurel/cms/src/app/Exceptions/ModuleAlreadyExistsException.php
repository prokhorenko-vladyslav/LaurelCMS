<?php


namespace Laurel\CMS\Exceptions;

use Exception;
use Throwable;

class ModuleAlreadyExistsException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
