<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



// As of Laravel 5.2 you need the web middleware for auth and stuff,
// but there seems to be a bug that adds it two times, if you enclose
// your routes with them. That causes the error message to get lost.
// For now we just removed the group.
//Route::group(['middleware' => ['web']], function () {

// Authentication Routes...
Route::get('login', 'Auth\AuthController@showLoginForm');
Route::post('login', 'Auth\AuthController@login');
Route::get('logout', 'Auth\AuthController@logout');

// Password Reset Routes...
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

Route::get('/', 'AttendeeController@index');
Route::get('/dashboard', function(){
   return view('home');
});

Route::get('/start', 'AttendeeController@index');
Route::get('/quiz/{pin}', 'AttendeeController@getQuiz');
Route::get('/search', 'SearchController@getSearch');
Route::get('attendees/create/{id}', 'AttendeeController@create');
Route::get('categories/{categories}/quizzes/{quizzes}/start', 'QuizController@start');
Route::get('categories/{categories}/quizzes/{quizzes}/next', 'QuizController@next');
Route::get('categories/{categories}/quizzes/{quizzes}/choices', 'QuizController@choices');

Route::resource('categories', 'CategoryController');
Route::resource('categories.quizzes', 'QuizController');
Route::resource('quizzes.questions', 'QuestionController');
Route::resource('attendee', 'AttendeeController');
Route::resource('share', 'ShareController');



