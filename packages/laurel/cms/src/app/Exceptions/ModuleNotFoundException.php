<?php


namespace Laurel\CMS\Exceptions;

use Exception;
use Throwable;

/**
 * Exception, which throws, when module has not been founded in the list of the registered items
 *
 * Class ModuleNotFoundException
 * @package Laurel\CMS\Exceptions
 */
class ModuleNotFoundException extends Exception
{
    /**
     * ModuleNotFoundException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
