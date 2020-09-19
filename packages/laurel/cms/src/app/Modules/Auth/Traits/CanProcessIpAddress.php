<?php


namespace Laurel\CMS\Modules\Auth\Traits;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Request;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressNotFoundException;
use Laurel\CMS\Modules\Auth\Models\User;

/**
 * Trait CanProcessIpAddress
 * @package Laurel\CMS\Modules\Auth\Traits
 */
trait CanProcessIpAddress
{
    /**
     * @param User $user
     * @return bool
     * @throws IpAddressNotFoundException
     */
    public function checkUserIp(User $user)
    {
        if (settingsModule()->setting('admin.check_ip_address')) {
            $ipAddress = $user->whereHas('ipAddresses', function (Builder $ipAddressQuery) {
                return $ipAddressQuery->where('ip_address', Request::ip())->where('is_blocked', false);
            })->count();

            throw_if(!$ipAddress, IpAddressNotFoundException::class, ...["IpAddress for user with id {$user->id} has not been found"]);
        }

        return true;
    }
}
