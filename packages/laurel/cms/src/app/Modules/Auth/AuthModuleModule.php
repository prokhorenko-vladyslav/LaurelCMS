<?php


namespace Laurel\CMS\Modules\Auth;

use Illuminate\Support\Facades\Route;
use Laurel\CMS\Modules\Auth\Contracts\AuthModuleContract;
use Laurel\CMS\Modules\Auth\Http\Middleware\LockCheckMiddleware;

class AuthModuleModule implements AuthModuleContract
{
    public function loadModuleApiRoutes() {
        Route::group([
            'namespace' => 'Http\\Controllers\\'
        ], function() {
            Route::post('login', 'AuthController@login')->name('login');

            Route::post('confirmIpAddress', 'AuthController@confirmIpAddress')->name('confirmIpAddress');

            Route::post('sendIpConfirmMail', 'AuthController@sendIpConfirmMail')->name('sendIpConfirmMail');

            Route::post('sendResetPasswordMail', 'AuthController@sendResetPasswordMail')->name('sendResetPasswordMail');

            Route::post('resetPassword', 'AuthController@resetPassword')->name('resetPassword');

            Route::middleware('auth:api')->group(function() {
                Route::post('unlock', 'AuthController@unlock')->name('unlock');
                Route::post('lockStatus', 'AuthController@lockStatus')->name('lockStatus');
                Route::post('checkToken', 'AuthController@checkToken')->name('checkToken');
            });
        });
    }
}
