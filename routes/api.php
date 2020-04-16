<?php

use App\Http\Controllers\Api\BlogController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function () {

    //Blog API Routes
    Route::get('/blog', 'BlogApiController@index');
    Route::post('/blog', 'BlogApiController@store');
    Route::get('/blog/{document', 'BlogApiController@show');
    Route::put('/blog/{document', 'BlogApiController@update');
    Route::delete('/blog/{document', 'BlogApiController@destroy');

    //Document API Routes
    Route::get('/document', 'DocumentApiController@index');
    Route::post('/document', 'DocumentApiController@store');
    Route::get('/document/{document}', 'DocumentApiController@show');
    Route::put('/document/{document}', 'DocumentApiController@update');
    Route::delete('/document/{document}', 'DocumentApiController@destroy');

    //Event API Routes
    Route::get('/event', 'EventApiController@index');
    Route::post('/event', 'EventApiController@store');
    Route::get('/event/{event}', 'EventApiController@show');
    Route::put('/event/{event}', 'EventApiController@update');
    Route::delete('/event/{event}', 'EventApiController@destroy');

    //Message API Routes
    Route::get('/message', 'MessageApiController@index');
    Route::post('/message', 'MessageApiController@store');
    Route::get('/message/{message}', 'MessageApiController@show');
    Route::put('/message/{message}', 'MessageApiController@update');
    Route::delete('/message/{message}', 'MessageApiController@destroy');

    //Note API Routes
    Route::get('/note', 'NoteApiController@index');
    Route::post('/note', 'NoteApiController@store');
    Route::get('/note/{note}', 'NoteApiController@show');
    Route::put('/note/{note}', 'NoteApiController@update');
    Route::delete('/note/{note}', 'NoteApiController@destroy');

    //Report API Routes
    Route::get('/report', 'ReportApiController@index');
    Route::post('/report', 'ReportApiController@store');
    Route::get('/report/{report}', 'ReportApiController@show');
    Route::put('/report/{report}', 'ReportApiController@update');
    Route::delete('/report/{report}', 'ReportApiController@destroy');

    //Staff API Routes
    Route::get('/staff', 'StaffApiController@index');
    Route::post('/staff', 'StaffApiController@store');
    Route::get('/staff/{staff}', 'StaffApiController@show');
    Route::put('/staff/{staff}', 'StaffApiController@update');
    Route::delete('/staff/{staff}', 'StaffApiController@destroy');

    //Student API Routes
    Route::get('/student', 'StudentApiController@index');
    Route::post('/student', 'StudentApiController@store');
    Route::get('/student/{student}', 'StudentApiController@show');
    Route::put('/student/{student}', 'StudentApiController@update');
    Route::delete('/student/{student}', 'StudentApiController@destroy');

    //Tutor API Routes
    Route::get('/getAllTutor', 'TutorApiController@index');
    Route::post('/tutor', 'TutorApiController@store');
    Route::get('/findTutor', 'TutorApiController@show');
    Route::put('/tutor/{tutor}', 'TutorApiController@update');
    Route::delete('/tutor/{tutor}', 'TutorApiController@destroy');
});
