<?php


namespace Laurel\CMS\Modules\Auth\Services;

use Laurel\CMS\Core\Responses\ServiceResponse;
use Illuminate\Support\Facades\Auth;
use Laurel\CMS\Modules\Auth\Exceptions\IncorrectCredentialsException;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressIsBlockedException;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressNotFoundException;
use Laurel\CMS\Modules\Auth\Exceptions\PasswordIncorrectException;
use Laurel\CMS\Modules\Auth\Models\User;
use Laurel\CMS\Modules\Auth\Traits\{ CanProcessIpAddress, CanProcessPassword, CanProcessApiToken };

/**
 * Class AuthService
 * @package Laurel\CMS\Modules\Auth\Services
 */
class AuthService
{
    use CanProcessIpAddress, CanProcessApiToken, CanProcessPassword;

    /**
     * @param string $login
     * @param string $password
     * @param bool $rememberMe
     * @return ServiceResponse
     * @throws IpAddressNotFoundException
     * @throws PasswordIncorrectException
     * @throws IpAddressIsBlockedException
     */
    public function login(string $login, string $password, bool $rememberMe = false) : ServiceResponse
    {
        $user = User::findByLogin($login);
        $this->checkUserPassword($user, $password);
        $this->checkUserIp($user);
        Auth::login($user, $rememberMe);

        throw_if(!Auth::check(), IncorrectCredentialsException::class);
        return serviceResponse(200, true, 'admin.auth.logged_in', [
            'token' => $this->createApiToken($user)
        ]);
    }
}
