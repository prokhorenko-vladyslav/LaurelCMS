<?php


namespace Laurel\CMS\Modules\Auth\Traits;

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
    public function createApiToken(User $user)
    {
        return $user->createToken(cms()->getAppName())->accessToken;
    }
}
