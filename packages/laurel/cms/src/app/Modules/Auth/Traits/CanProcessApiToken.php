<?php


namespace Laurel\CMS\Modules\Auth\Traits;

use Laurel\CMS\Core\Responses\ServiceResponse;
use Laurel\CMS\Modules\Auth\Models\User;

/**
 * Trait CanProcessApiToken
 * @package Laurel\CMS\Modules\Auth\Traits
 */
trait CanProcessApiToken
{
    /**
     * @param User $user
     * @return string
     */
    public function createApiToken(User $user) : string
    {
        return $user->createToken(cms()->getAppName())->accessToken;
    }

    public function checkToken() : ServiceResponse
    {
        if (auth()->user()->isBlocked()) {
            return serviceResponse(401, false, 'auth.user_blocked', [], 'User has been blocked');
        } else {
            return serviceResponse(200, true, 'auth.user_has_access', [], 'User has access');
        }
    }
}
