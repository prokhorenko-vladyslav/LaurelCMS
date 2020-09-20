<?php


namespace Laurel\CMS\Modules\Auth\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressIsBlockedException;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressNotFoundException;
use Laurel\CMS\Modules\Auth\Http\Requests\ConfirmIpAddressRequest;
use Laurel\CMS\Modules\Auth\Http\Requests\ResetPasswordRequest;
use Laurel\CMS\Modules\Auth\Http\Requests\LoginRequest;
use Laurel\CMS\Modules\Auth\Http\Requests\SendIpConfirmMailRequest;
use Laurel\CMS\Modules\Auth\Http\Requests\SendResetPasswordMailRequest;
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
                $request->input('login'),
                $request->input('password'),
                $request->input('rememberMe', false)
            )->respond();
        } catch (IpAddressNotFoundException $e) {
            return $this->authService->sendIpConfirmMail(
                $request->validated()['login']
            )->respond();
        } catch (IpAddressIsBlockedException $e) {
            return serviceResponse(403, false, 'admin.auth.ip_address_blocked', [], "Ip address " . Request::ip() . " has been blocked")->respond();
        } catch (Exception $e) {
            return serviceResponse(404, false, 'admin.auth.incorrect_credentials', [], 'User with this credentials has not been founded')->respond();
        }
    }

    public function sendIpConfirmMail(SendIpConfirmMailRequest $request)
    {
        try {
            return $this->authService->sendIpConfirmMail($request->input('login'))->setMessage('Mail with ip confirmation code has been sent')->respond();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return serviceResponse(500, false, 'server_error')->respond();
        }
    }

    public function confirmIpAddress(ConfirmIpAddressRequest $request)
    {
        try {
            return $this->authService->confirmIpAddress(
                $request->input('login'),
                $request->input('ip_address'),
                $request->input('code'),
            )->respond();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return serviceResponse(500, false, 'server_error')->respond();
        }
    }

    public function sendResetPasswordMail(SendResetPasswordMailRequest $request)
    {
        try {
            return $this->authService->sendResetPasswordMail(
                $request->input('login')
            )->respond();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return serviceResponse(500, false, 'server_error')->respond();
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        try {
            return $this->authService->resetPassword(
            $request->input('login'),
            $request->input('token'),
            $request->input('new_password'),
        )->respond();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return serviceResponse(500, false, 'server_error')->respond();
        }
    }

    public function unlock()
    {
        dd('unlock');
    }
}
