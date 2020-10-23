<?php


namespace Laurel\CMS\Modules\Notification;


use Laurel\CMS\Modules\Notification\Contracts\NotificationsModuleContract;

class NotificationsModule implements NotificationsModuleContract
{
    public function send($notifiable)
    {
        /*dd($notifiable);
        dd('yes1');*/
    }
}
