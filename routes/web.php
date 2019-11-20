<?php

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

Route::get('/', function () {
    user()->grantReadAccess(\App\Models\Permission::class, 1);
    user()->grantEditAccess(\App\Models\Permission::class, true);
    user()->grantAccess(\App\Models\Role::class);
    user()->disableAccess(\App\Models\User::class);

    return view('welcome');
});
