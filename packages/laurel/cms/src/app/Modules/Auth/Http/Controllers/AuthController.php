<?php


namespace Laurel\CMS\Modules\Auth\Http\Controllers;

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
        return $this->authService->login(
            $request->validated()['login'],
            $request->validated()['password'],
            (bool)$request->validated()['rememberMe']
        )->toArray();
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
