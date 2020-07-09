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

Route::prefix('admin')->group(function () {
    Route::get('/login', function () {
        return view('admin.master');
    });
    Route::get('/lock', function () {
        return view('admin.master');
    });
});

Route::get('/foo', function () {
    return view('admin.master');
});

Route::get('/bar', function () {
    return view('admin.master');
});
