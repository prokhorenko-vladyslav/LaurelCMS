<?php


namespace Laurel\CMS\Exceptions;

use Exception;
use Throwable;

/**
 * Exception, which throws, when alias class for module has not been founded
 *
 * Class AliasHasNotBeenFoundedException
 * @package Laurel\CMS\Exceptions
 */
class AliasHasNotBeenFoundedException extends Exception
{
    /**
     * AliasHasNotBeenFoundedException constructor.
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
