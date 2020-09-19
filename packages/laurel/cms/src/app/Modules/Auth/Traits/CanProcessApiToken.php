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
    public function createApiToken(User $user)
    {
        return $user->createToken(cms()->getAppName())->accessToken;
    }

    public function sendIpConfirmMail(string $login) : ServiceResponse
    {
        $user = User::findUserByLogin($login);
        return serviceResponse(200, true, 'admin.auth.ip_confirm_mail_sent',[],'You have tried to login using unknown ip address. Please, confirm it.');
    }
}
