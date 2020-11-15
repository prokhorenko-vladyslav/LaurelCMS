<?php


namespace Laurel\CMS\Modules\Notification\Types;


use Laurel\CMS\Modules\Notification\Abstracts\Notification;

class SuccessNotification extends Notification
{
    /**
     * Returns type of notification
     *
     * @return string
     */
    public function getType(): string
    {
        return 'success';
    }
}
