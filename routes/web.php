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
    dd(user()->hasAccess('add', \App\Models\Permission::class));

    return view('welcome');
});

Route::get('/login', function() {
    return view('admin.login');
});

Route::get('/admin', function() {
   return view('admin.dashboard');
});
