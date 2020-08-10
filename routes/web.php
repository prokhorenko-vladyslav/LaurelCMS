<?php

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

Route::group([
    'prefix' => 'admin',
    'name' => 'admin.'
], function () {
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

    Route::get('/dashboard', function () {
        return view('admin.master');
    });
});

Route::get('/foo', function () {
    return view('admin.master');
});

Route::get('/bar', function () {
    return view('admin.master');
});
