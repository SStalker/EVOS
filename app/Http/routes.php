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



// As of Laravel 5.2 you need the web middlware for auth and stuff,
// but there seems to be a bug that adds it two times, if you enclose
// your routes with them. That causes the error message to get lost.
// For now we just removed the group.
//Route::group(['middleware' => ['web']], function () {

Route::auth();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/attendees/create', 'AttendeeController@create');

Route::resource('quizzes', 'QuizController');
Route::resource('questions', 'QuestionController');
Route::resource('categories', 'CategoryController');

//});

