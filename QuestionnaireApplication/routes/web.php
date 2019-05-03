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
Route::resource('question', 'QuestionsController');
Route::resource('questionanswers', 'QuestionAnswersController');
Route::resource('boundaries', 'QuestionnaireBoundariesController');
Route::resource('questionnaireresults', 'QuestionnaireResultsController');
Route::resource('questionnairenotes', 'QuestionnaireNotesController');
Route::resource('result', 'QuestionnaireBoundariesController');

/* Users */
Route::resource('address', 'UserAddressController');
Route::resource('usertype', 'UserTypesController');
Route::resource('user', 'UserController');

/* System Config */
Route::resource('languages', 'LanguagesController');
Route::resource('tags', 'TagsController');
Route::resource('systemconfiguration', 'SystemConfigController');
Route::resource('healthcarecontacts', 'HealthcareContactsController');
Route::resource('usertypes', 'UserTypesController');

/* Patients */
Route::resource('patients', 'PatientsController');
Route::prefix('patient')->group(function() {
    Route::get('/login', 'Auth\PatientLoginController@showLoginForm')->name('patient.login');
    Route::post('/login', 'Auth\PatientLoginController@login')->name('patient.login.submit');
    Route::get('/', 'PatientController@index')->name('patient.dashboard');
});
