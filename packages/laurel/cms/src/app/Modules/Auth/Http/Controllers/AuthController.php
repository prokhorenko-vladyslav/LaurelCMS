<?php


namespace Laurel\CMS\Modules\Auth\Http\Controllers;

use Exception;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressNotFoundException;
use Laurel\CMS\Modules\Auth\Http\Requests\LoginRequest;
use Laurel\CMS\Modules\Auth\Services\AuthService;

class AuthController
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(LoginRequest $request)
    {
        try {
            return $this->authService->login(
                $request->validated()['login'],
                $request->validated()['password'],
                $request->validated()['rememberMe'] ?? false
            )->respond();
        } catch (IpAddressNotFoundException $e) {
            return $this->authService->sendIpConfirmMail(
                $request->validated()['login']
            )->respond();
        } catch (Exception $e) {
            return serviceResponse(404, false, 'admin.auth.incorrect_credentials', [], 'User with this credentials has not been founded')->respond();
        }
    }

    public function sendIpConfirmMail()
    {

    }

    public function forgotPassword()
    {
        dd('forgot-password');
    }

    public function unlock()
    {
        dd('unlock');
    }
}
