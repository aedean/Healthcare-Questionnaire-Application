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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/* System Config */
Route::resource('languages', 'LanguagesController');
Route::resource('tags', 'TagsController');
Route::resource('systemconfiguration', 'SystemConfigController');
Route::resource('healthcareworkers', 'HealthcareWorkersController');