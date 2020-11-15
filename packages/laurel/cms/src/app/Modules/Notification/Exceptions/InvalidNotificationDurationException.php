<?php

namespace Laurel\CMS\Modules\Notification\Exceptions;

use Exception;
use Laurel\CMS\Modules\Notification\Contracts\NotificationTypeContract;
use Throwable;

/**
 * Throws, when notification duration less than 0 or more than 999
 *
 * Class InvalidNotificationTypeException
 * @package Laurel\CMS\Exceptions
 */
class InvalidNotificationDurationException extends Exception
{
    public function __construct(int $duration, $code = 0, Throwable $previous = null)
    {
        $message = __('exceptions.invalid_duration_for_notification', [
            'duration' => $duration
        ]);
        parent::__construct($message, $code, $previous);
    }
}
