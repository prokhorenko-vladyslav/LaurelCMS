<?php


namespace Laurel\CMS\Modules\Notification\Abstracts;


use Illuminate\Contracts\Support\Arrayable;
use Laurel\CMS\Modules\Notification\Exceptions\InvalidNotificationDurationException;

/**
 * Base class for all popup notifications
 *
 * Class Notification
 * @package Laurel\CMS\Modules\Notification\Abstracts
 */
abstract class Notification implements Arrayable
{
    /**
     * Notification message
     *
     * @var string
     */
    protected string $message;

    /**
     * Is notification large or not
     *
     * @var bool
     */
    protected bool $isLarge;

    /**
     * Duration of notification visibility
     *
     * @var int
     */
    protected int $duration;

    /**
     * Notification constructor.
     *
     * @param string $message
     * @param bool $isLarge
     * @param int $duration
     * @throws \Throwable
     */
    final public function __construct(string $message, bool $isLarge = false, int $duration = 10)
    {
        throw_if($duration <= 0 || $duration > 999, InvalidNotificationDurationException::class, ...[$duration]);
        $this->message = $message;
        $this->isLarge = $isLarge;
        $this->duration = $duration;
    }

    /**
     * Returns type of notification
     *
     * @return string
     */
    public abstract function getType() : string;

    /**
     * Returns message of notification
     *
     * @return string
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * Returns true, if notification size is large
     *
     * @return bool
     */
    public function isLarge() : bool
    {
        return $this->isLarge;
    }

    /**
     * Returns duration of notification visibility
     *
     * @return int
     */
    public function getDuration() : int
    {
        return $this->duration;
    }

    /**
     * Create array with data
     *
     * @return array
     */
    public final function toArray() : array
    {
        return [
            'type'      => $this->getType(),
            'isLarge'   => $this->isLarge(),
            'duration'  => $this->getDuration(),
            'message'   => $this->getMessage()
        ];
    }
}
