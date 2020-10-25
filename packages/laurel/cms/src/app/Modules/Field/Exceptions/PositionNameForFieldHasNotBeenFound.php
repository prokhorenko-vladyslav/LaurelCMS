<?php


namespace Laurel\CMS\Modules\Field\Exceptions;


use Exception;
use Throwable;

/**
 * Throws, when position name in field has not been found
 *
 * Class PositionNameForFieldHasNotBeenFound
 * @package Laurel\CMS\Modules\Field\Exceptions
 */
class PositionNameForFieldHasNotBeenFound extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("Position name has not been found", $code, $previous);
    }
}
