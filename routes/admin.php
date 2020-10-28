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
Route::get('login', 'Admin\Auth\LoginController@showLoginForm')
        ->middleware('admin.guest:admin')
        ->name('admin.login.show');
Route::get('/', 'Admin\HomeController@index')
        ->name('admin.home');

Route::post('login', 'Admin\Auth\LoginController@postLogin')
        ->middleware('admin.guest:admin')
        ->name('admin.login.post');

Route::post('logout', 'Admin\Auth\LoginController@postLogout')
        ->middleware('auth:admin')
        ->name('admin.logout');

Route::post('/admin/useraction', 'Admin\HomeController@userAction')
        ->middleware('auth:admin')
        ->name('admin.useraction');
