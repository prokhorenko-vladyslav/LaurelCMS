<?php

namespace Laurel\CMS\Modules\Notification\Exceptions;

use Exception;
use Laurel\CMS\Modules\Notification\Contracts\NotificationTypeContract;
use Throwable;

/**
 * Throws, when notification type is invalid
 *
 * Class InvalidNotificationTypeException
 * @package Laurel\CMS\Exceptions
 */
class InvalidNotificationTypeException extends Exception
{
    public function __construct(string $wrongClassName, $code = 0, Throwable $previous = null)
    {
        $message = __('exceptions.invalid_type_of_notification', [
            'className' => $wrongClassName,
            'contractName' => NotificationTypeContract::class
        ]);
        parent::__construct($message, $code, $previous);
    }
}
