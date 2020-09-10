<?php


namespace Laurel\CMS\Modules\Auth\Http\Controllers;


use Laurel\CMS\LaurelCMS;

class AuthController
{
    public function login()
    {
        dd(LaurelCMS::instance()->getApiRoutes());
        dd('login');
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
