<?php


namespace Laurel\CMS\Exceptions;

use Exception;
use Throwable;

/**
 * Exception, which throws, when module cannot be unloaded and forgotten.
 * It sets in the canBeForgotten() method in the module main class
 *
 * Class ModuleCannotBeForgottenException
 * @package Laurel\CMS\Exceptions
 */
class ModuleCannotBeForgottenException extends Exception
{
    /**
     * ModuleCannotBeForgottenException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
