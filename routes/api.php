<?php

use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\MeetingApiController;
use App\Http\Controllers\Api\StatApiController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::namespace('Api')->group(function () {

    // public routes
    Route::post('/login', 'AuthController@login')->name('login.api');
    Route::post('/register', 'AuthController@register')->name('register.api');

    // private routes
    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', 'AuthController@logout')->name('logout');
    });

    //Message API Routes
    Route::get('/showMessage', 'MessageApiController@showMessage');
    Route::post('/writeMessage', 'MessageApiController@writeMessage');

    //Staff API Routes
    Route::get('/getAllStaff', 'StaffApiController@index');
    Route::post('/addStaff', 'StaffApiController@store');
    Route::get('/getStaff', 'StaffApiController@show');
    Route::put('/staff/{staff}', 'StaffApiController@update');
    Route::delete('/deleteStaff', 'StaffApiController@destroy');

    //Student API Routes
    Route::get('/getAllStudents', 'StudentApiController@index');
    Route::get('/getStudentsByTutorId', 'StudentApiController@indexByTutor');
    Route::post('/setTutorToStudent', 'StudentApiController@setPersonalTutor');
    Route::get('/getStudent', 'StudentApiController@show');
    Route::get('/getTutorOfStudent  ', 'StudentApiController@getTutor');
    Route::post('/deleteStudent', 'StudentApiController@destroy');
    Route::get('/studentsWithNoInteraction', 'StudentApiController@studentsWithNoInteraction');
    Route::get('/studentsWithoutTutor', 'StudentApiController@studentsWithoutTutor');
    Route::get('/getTutorByStudentId', 'StudentApiController@getTutor');

    //Tutor API Routes
    Route::get('/getAllTutor', 'TutorApiController@index'); //View all
    Route::post('/addTutor', 'TutorApiController@store'); //Add
    Route::get('/getTutor', 'TutorApiController@show'); //Get 1
    Route::get('/findTutorByName', 'TutorApiController@findTutorByName');
    Route::post('/updateTutor', 'TutorApiController@update');
    Route::post('/deleteTutor', 'TutorApiController@destroy');

    //Meeting API Routes
    Route::get('/getAllMeetings', 'MeetingApiController@index');
    Route::get('/getAllMeetingsByUserId', 'MeetingApiController@showById');
    Route::post('/createMeeting', 'MeetingApiController@store');
    Route::post('/studentCreateMeeting', 'MeetingApiController@studentCreateMeeting');
    Route::get('/getMeeting', 'MeetingApiController@show');
    Route::get('/getMeetingByHost', 'MeetingApiController@showByHost');
    Route::get('/getMeetingByInvite', 'MeetingApiController@showByInvite');
    Route::post('/deleteMeeting', 'MeetingApiController@destroy');

    //Note API Routes
    Route::post('/addNote', 'NoteApiController@addNote');
    Route::get('/showNotes', 'NoteApiController@viewNotes');

    //chat API Routes
    Route::get('/getAllMessage', 'ChatApiController@getAllMessage');
    Route::post('/sendMessage', 'ChatApiController@sendMessage');

    //Notification
    Route::get('/getNotification', 'LogApiController@index');

    //Statistics
    Route::get('/getNumberOfChat', 'StatApiController@messagesLast7Days');
    Route::get('/getNumberOfChatTutor', 'StatApiController@tutorMessagesLast7Days');
    Route::get('/getNumberOfChatStudent', 'StatApiController@studentMessagesLast7Days');
});
