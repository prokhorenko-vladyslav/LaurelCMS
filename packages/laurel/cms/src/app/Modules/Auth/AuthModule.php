<?php


namespace Laurel\CMS\Modules\Auth;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Laurel\CMS\Abstracts\Module;

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
            Route::get('login', 'AuthController@login')->name('login');

            Route::post('forgot-password', 'AuthController@forgotPassword')->name('forgot-password');

            Route::post('unlock', 'AuthController@unlock')->name('unlock');
        });
    }
}
