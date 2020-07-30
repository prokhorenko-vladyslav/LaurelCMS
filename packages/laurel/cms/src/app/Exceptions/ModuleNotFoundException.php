<?php


namespace Laurel\CMS\Exceptions;

use Exception;
use Throwable;

class ModuleNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
