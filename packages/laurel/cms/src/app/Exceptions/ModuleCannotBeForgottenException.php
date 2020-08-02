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

}
