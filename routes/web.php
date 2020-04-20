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

Route::get('/staff', function () {
    return view('staff');
});

//Tutor route
Route::get('/tutors', 'TutorController@index');
Route::post('/tutors', 'TutorController@store');
Route::get('/tutors/create', 'TutorController@create');
Route::get('/tutors/{tutor}', 'TutorController@show');
Route::get('/tutors/{tutor}/edit', 'TutorController@edit');
Route::put('/tutors/{tutor}', 'TutorController@update');
Route::delete('/tutors/{tutor}', 'TutorController@destroy');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
