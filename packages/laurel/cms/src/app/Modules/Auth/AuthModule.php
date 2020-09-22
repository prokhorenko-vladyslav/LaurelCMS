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

            Route::post('confirmIpAddress', 'AuthController@confirmIpAddress')->name('confirmIpAddress');

            Route::post('sendIpConfirmMail', 'AuthController@sendIpConfirmMail')->name('sendIpConfirmMail');

            Route::post('sendResetPasswordMail', 'AuthController@sendResetPasswordMail')->name('sendResetPasswordMail');

            Route::post('resetPassword', 'AuthController@resetPassword')->name('reset-password');

            Route::middleware('auth:api')->group(function() {
                Route::post('unlock', 'AuthController@unlock')->name('unlock');
                Route::post('checkToken', 'AuthController@checkToken')->name('checkToken');
            });
        });
    }
}
