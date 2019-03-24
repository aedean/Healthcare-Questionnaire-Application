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

/* Questionnaire Routes */
Route::resource('questionnaires', 'QuestionnairesController');
Route::resource('questionnairetags', 'QuestionnaireTagsController');
Route::resource('questionnairelanguages', 'QuestionnaireLanguagesController');
Route::resource('questions', 'QuestionsController');
Route::resource('questionanswers', 'QuestionAnswersController');
Route::get('/question/create', 'QuestionController@create')->name('questioncreation');

/* Users */
Route::resource('address', 'UserAddressController');
Route::resource('usertype', 'UserTypesController');
Route::resource('user', 'UserController');
