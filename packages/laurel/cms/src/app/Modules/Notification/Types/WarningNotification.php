<?php


namespace Laurel\CMS\Modules\Notification\Types;


use Laurel\CMS\Modules\Notification\Abstracts\Notification;

class WarningNotification extends Notification
{

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'warn';
    }
}
