<?php


namespace Laurel\CMS\Modules\Auth\Services;


use Illuminate\Support\Facades\Auth;
use Laurel\CMS\Core\Responses\ServiceResponse;

class AuthService
{
    public function login(string $login, string $password, bool $rememberMe = false) : ServiceResponse
    {
        if(filter_var($login, FILTER_VALIDATE_EMAIL)) {
            $loggedIn = Auth::attempt(['email' => $login, 'password' => $password], $rememberMe);
        } else {
            $loggedIn = Auth::attempt(['login' => $login, 'password' => $password], $rememberMe);
        }

        if ($loggedIn) {
            return serviceResponse(200, $loggedIn, [
                'token' => Auth::user()->createToken(config('app.name'))->accessToken
            ]);
        } else {
            return serviceResponse(404, $loggedIn);
        }
    }
}
