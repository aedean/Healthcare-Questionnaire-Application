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

/* Users */
Route::resource('address', 'UserAddressController');
Route::resource('usertype', 'UserTypesController');
Route::resource('user', 'UserController');
Route::resource('patients', 'PatientsController');
Route::resource('patients', 'PatientsController');
Route::get('/patients/login', function() {
    return view('patients.login');
});
Route::prefix('admin')->group(function() {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
  

/* System Config */
Route::resource('languages', 'LanguagesController');
Route::resource('tags', 'TagsController');
Route::resource('systemconfiguration', 'SystemConfigController');
Route::resource('healthcareworkers', 'HealthcareWorkersController');
Route::resource('usertypes', 'UserTypesController');