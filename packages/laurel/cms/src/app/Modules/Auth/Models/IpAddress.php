<?php


namespace Laurel\CMS\Modules\Auth\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * Class IpAddress
 * @package Laurel\CMS\Modules\Auth\Models
 * @property bool $is_blocked
 * @property bool $is_confirmed
 */

class IpAddress extends Model
{
    protected $fillable = [
        'ip_address'
    ];

    public function isBlocked() : bool
    {
        return (bool)$this->is_blocked;
    }
}
