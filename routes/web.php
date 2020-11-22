<?php

use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

foreach (cms()->modules() as $module) {
    if (method_exists($module, 'routes')) {
        $module->routes('web');
    }
}

Route::group([
    'prefix' => 'admin',
    'name' => 'admin.'
], function () {
    Route::get('', function () {
        return view('admin.master');
    });

    Route::get('/login', function () {
        return view('admin.master');
    });
    Route::get('/ipConfirm', function () {
        return view('admin.master');
    });
    Route::get('/forgot', function () {
        return view('admin.master');
    });
    Route::get('/lock', function () {
        return view('admin.master');
    });

    Route::get('/pages', function () {
        return view('admin.master');
    });

    Route::get('/pages/create', function () {
        return view('admin.master');
    });

    Route::get('/settings/{slug}', function () {
        return view('admin.master');
    });
});

Route::get('/foo', function () {
    return view('admin.master');
});

Route::get('/bar', function () {
    return view('admin.master');
});
