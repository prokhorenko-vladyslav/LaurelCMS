<?php


namespace Laurel\CMS\Core\Responses;


use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;
use Laurel\CMS\Modules\Notification\Abstracts\Notification;
use Laurel\CMS\Modules\Notification\Exceptions\InvalidNotificationTypeException;

class ServiceResponse
{
    protected int $code;
    protected bool $status;
    protected string $alias;
    protected $data;
    protected Collection $notifications;

    public function __construct(int $code, bool $status, string $alias, $data = [], $notifications = [])
    {
        $this->code = $code;
        $this->status = $status;
        $this->alias = $alias;
        $this->data = $data;
        $this->notifications = collect([]);
        $this->addNotification($notifications);
    }

    public function getCode() : int
    {
        return $this->code;
    }

    public function getStatus() : bool
    {
        return $this->status;
    }

    public function getAlias() : string
    {
        return $this->alias;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getNotifications() : Collection
    {
        return $this->notifications;
    }

    public function addNotification($notifications = []) : self
    {
        if (!is_array($notifications)) {
            $notifications = [$notifications];
        }
        foreach ($notifications as $notificationItem) {
            throw_if(!$notificationItem instanceof Notification, InvalidNotificationTypeException::class, ...[ gettype($notificationItem) === 'object' ? get_class($notificationItem) : gettype($notificationItem) ]);
            $this->notifications->push($notificationItem);
        }
        return $this;
    }

    public function toArray() : array
    {
        $responseData = [
            'code' => $this->code,
            'status' => $this->status,
            'alias' => $this->alias,
            'notifications' => $this->notifications->toArray()
        ];

        if ($this->data instanceof ResourceCollection) {
            $responseData = array_merge($responseData, $this->data->response()->getData(true));
        } else {
            $responseData['data'] = $this->data;
        }

        return $responseData;
    }

    public function respond(array $headers = [], $options = 0)
    {
        return response()->json(
            $this->toArray(),
            $this->code,
            $headers,
            $options
        );
    }
}
