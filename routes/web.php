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
Route::get('/', 'HomeController@index')->name('home');
//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::any('/home/note', 'HomeController@note');
//Route::get('/adminlogin', 'AdminController@login')->name('adminlogin');
//Route::post('/adminlogin', 'AdminController@loginPost');
//Route::post('/admin/useraction', 'AdminController@userAction');
