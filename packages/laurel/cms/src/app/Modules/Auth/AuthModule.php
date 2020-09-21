<?php


namespace Laurel\CMS\Modules\Auth;

use Illuminate\Support\Facades\Route;
use Laurel\CMS\Abstracts\Module;
use Laurel\CMS\Modules\Auth\Http\Middleware\LockCheckMiddleware;

class AuthModule extends Module
{
    public function register()
    {

    }

    public function login()
    {

    }

    public function forgotPassword()
    {

    }

    public function changePassword()
    {

    }

    public function createToken()
    {

    }

    public function updateToken()
    {

    }

    public function createResetPasswordEmail()
    {

    }

    public function sendResetPasswordEmail()
    {

    }

    public function loadModuleApiRoutes() {
        Route::group([
            'namespace' => 'Http\\Controllers\\'
        ], function() {
            Route::post('login', 'AuthController@login')->name('login');

            Route::post('confirmIpAddress', 'AuthController@confirmIpAddress')->name('confirm-ip-address');

            Route::post('sendIpConfirmMail', 'AuthController@sendIpConfirmMail')->name('send-ip-confirm-mail');

            Route::post('sendResetPasswordMail', 'AuthController@sendResetPasswordMail')->name('send-reset-password-mail');

            Route::post('resetPassword', 'AuthController@resetPassword')->name('reset-password');

            Route::middleware('auth:api')->post('unlock', 'AuthController@unlock')->name('unlock');
        });
    }
}
