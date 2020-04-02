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

Auth::routes();

Route::get('/', 'ChurchController@index')->name('welcome');
Route::get('/live', 'ChurchController@live')->name('live');
Route::get('/sermons', 'ChurchController@sermons')->name('sermons');
/*
Bible Routes
*/

include('bible/routes.php');
