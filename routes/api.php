<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MeetingApiController;
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

Route::group(['middleware' => ['json.response']], function () {

    // public routes
    Route::post('/login', 'Api\AuthController@login')->name('login.api');
    Route::post('/register', 'Api\AuthController@register')->name('register.api');

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'Api\AuthController@logout')->name('logout');
    });

});

Route::namespace('Api')->group(function () {

    //Blog API Routes
    Route::get('/blog', 'BlogApiController@index');
    Route::post('/saveStudentBlog', 'BlogApiController@saveStudentBlog');
    Route::post('/saveTutorBlog', 'BlogApiController@saveTutorBlog');
    Route::get('/showStudentBlogs', 'BlogApiController@showStudentBlog');
    Route::get('/showTutorBlogs', 'BlogApiController@showTutorBlog');
    Route::put('/blog/{document}', 'BlogApiController@update');
    Route::delete('/deleteBlog', 'BlogApiController@destroy');

    //Document API Routes
    Route::get('/document', 'DocumentApiController@index');
    Route::post('/document', 'DocumentApiController@store');
    Route::get('/getDocument', 'DocumentApiController@show');
    Route::put('/document/{document}', 'DocumentApiController@update');
    Route::delete('/document/{document}', 'DocumentApiController@destroy');

    //Event API Routes
    Route::get('/getAllEvents', 'EventApiController@index');
    Route::post('/addNewEvent', 'EventApiController@store');
    Route::get('/getEvents', 'EventApiController@show');
    Route::put('/event/{event}', 'EventApiController@update');
    Route::delete('/deleteEvent', 'EventApiController@destroy');

    //Message API Routes
    // Route::get('/message', 'MessageApiController@index');
    // Route::post('/message', 'MessageApiController@store');
    // Route::get('/message/{message}', 'MessageApiController@show');
    // Route::put('/message/{message}', 'MessageApiController@update');
    // Route::delete('/message/{message}', 'MessageApiController@destroy');
    Route::get('/showMessage', 'MessageApiController@showMessage');
    Route::post('/writeMessage', 'MessageApiController@writeMessage');

    //Note API Routes
    Route::get('/getAllNotes', 'NoteApiController@index');
    Route::post('/addStudentNote', 'NoteApiController@addStudentNote');
    Route::post('/addTutorNote', 'NoteApiController@addTutorNote');
    Route::get('/showStudentNotes', 'NoteApiController@showStudentNotes');
    Route::get('/showTutorNotes', 'NoteApiController@showTutorNotes');
    Route::put('/note/{note}', 'NoteApiController@update');
    Route::delete('/deleteNote', 'NoteApiController@destroy');

    //Report API Routes
    Route::get('/getReport', 'ReportApiController@index');
    Route::post('/report', 'ReportApiController@store');
    Route::get('/createReport', 'ReportApiController@show');
    Route::put('/report/{report}', 'ReportApiController@update');
    Route::delete('/report/{report}', 'ReportApiController@destroy');

    //Staff API Routes
    Route::get('/getAllStaff', 'StaffApiController@index');
    Route::post('/addStaff', 'StaffApiController@store');
    Route::get('/getStaff', 'StaffApiController@show');
    Route::put('/staff/{staff}', 'StaffApiController@update');
    Route::delete('/deleteStaff', 'StaffApiController@destroy');

    //Student API Routes
    Route::get('/getAllStudents', 'StudentApiController@index');
    Route::post('/addStudent', 'StudentApiController@store');
    Route::post('/setTutorToStudent', 'StudentApiController@setPersonalTutor');
    Route::get('/getStudent', 'StudentApiController@show');
    Route::get('/findStudentByName', 'StudentApiController@findStudentByName');
    Route::post('/updateStudentInfo', 'StudentApiController@update');
    Route::post('/deleteStudent', 'StudentApiController@destroy');
    Route::get('/studentsWithNoInteraction', 'StudentApiController@studentsWithNoInteraction');
    Route::get('/studentsWithoutTutor', 'StudentApiController@studentsWithoutTutor');

    //Tutor API Routes
    Route::get('/getAllTutor', 'TutorApiController@index'); //View all
    Route::post('/addTutor', 'TutorApiController@store'); //Add
    Route::get('/getTutor', 'TutorApiController@show'); //Get 1
    Route::get('/findTutorByName', 'TutorApiController@findTutorByName');
    Route::post('/updateTutor', 'TutorApiController@update');
    Route::post('/deleteTutor', 'TutorApiController@destroy');

    //Meeting API Routes
    Route::get('/getAllMeetings', 'MeetingApiController@index');
    Route::post('/createMeeting', 'MeetingApiController@store');
    Route::get('/getMeeting', 'MeetingApiController@show');
});
