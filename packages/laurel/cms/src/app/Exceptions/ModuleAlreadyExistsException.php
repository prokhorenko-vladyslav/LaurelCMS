<?php


namespace Laurel\CMS\Exceptions;

use Exception;
use Throwable;

/**
 * Exception, which throws, when module with the same alias already has been registered
 *
 * Class ModuleAlreadyExistsException
 * @package Laurel\CMS\Exceptions
 */
class ModuleAlreadyExistsException extends Exception
{
    /**
     * ModuleAlreadyExistsException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
