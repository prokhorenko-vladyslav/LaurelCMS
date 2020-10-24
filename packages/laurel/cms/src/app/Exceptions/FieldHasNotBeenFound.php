<?php


namespace Laurel\CMS\Exceptions;


use Exception;
use Throwable;

/**
 * Throws, when field has not been deleted
 *
 * Class FieldHasNotBeenFound
 * @package Laurel\CMS\Exceptions
 */
class FieldHasNotBeenFound extends Exception
{
    public function __construct($fieldName, $code = 0, Throwable $previous = null)
    {
        parent::__construct($fieldName . " has not been found or not registered", $code, $previous);
    }
}
