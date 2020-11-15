<?php


namespace Laurel\CMS\Modules\Auth\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressIsBlockedException;
use Laurel\CMS\Modules\Auth\Exceptions\IpAddressNotFoundException;
use Laurel\CMS\Modules\Auth\Http\Requests\{CheckTokenRequest,
    ConfirmIpAddressRequest,
    ResetPasswordRequest,
    LoginRequest,
    SendIpConfirmMailRequest,
    SendResetPasswordMailRequest,
    UnlockRequest,
    CheckLockRequest
};
use Laurel\CMS\Modules\Auth\Exceptions\PasswordIncorrectException;
use Laurel\CMS\Modules\Auth\Services\AuthService;
use Laurel\CMS\Modules\Notification\Types\ErrorNotification;
use Laurel\CMS\Modules\Notification\Types\InfoNotification;
use Laurel\CMS\Modules\Notification\Types\WarningNotification;

class AuthController
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function checkToken(CheckTokenRequest $request)
    {
        try {
            return $this->authService->checkToken()->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
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
            return serviceResponse(403, false, 'admin.auth.ip_address_blocked', [], new ErrorNotification("Ip address " . Request::ip() . " has been blocked"))->respond();
        } catch (Exception $e) {
            return serviceResponse(401, false, 'admin.auth.incorrect_credentials', [], new WarningNotification('User with this credentials has not been founded'))->respond();
        }
    }

    public function sendIpConfirmMail(SendIpConfirmMailRequest $request)
    {
        try {
            return $this->authService
                ->sendIpConfirmMail($request->input('login'))
                ->addNotification(new InfoNotification('Mail with ip confirmation code has been sent'))
                ->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function confirmIpAddress(ConfirmIpAddressRequest $request)
    {
        try {
            return $this->authService->confirmIpAddress(
                $request->input('login'),
                $request->input('ipAddress'),
                $request->input('code'),
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function sendResetPasswordMail(SendResetPasswordMailRequest $request)
    {
        try {
            return $this->authService->sendResetPasswordMail(
                $request->input('login')
            )->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
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
            return logAndSendServerError($e->getMessage());
        }
    }

    public function unlock(UnlockRequest $request)
    {
        try {
            return $this->authService->unlock(
                $request->input('password')
            )->respond();
        } catch (PasswordIncorrectException $e) {
            return serviceResponse(401, false, 'admin.auth.incorrect_credentials', [], 'User with this credentials has not been founded')->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }

    public function lockStatus(CheckLockRequest $request)
    {
        try {
            return $this->authService->getLockStatus()->respond();
        } catch (Exception $e) {
            return logAndSendServerError($e->getMessage());
        }
    }
}
