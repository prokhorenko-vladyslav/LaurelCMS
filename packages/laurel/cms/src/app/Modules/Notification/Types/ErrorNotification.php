<?php


namespace Laurel\CMS\Modules\Notification\Types;


use Laurel\CMS\Modules\Notification\Abstracts\Notification;

class ErrorNotification extends Notification
{

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return 'error';
    }
}
