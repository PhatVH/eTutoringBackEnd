<?php

namespace App\Http\Controllers\Api;

use App\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageApiController extends Controller
{
    public function showMessage()
    {
        $student = request('student_ID');
        $tutor = request('tutor_ID');

        $mess = Message::where([
            'tutor_ID' => $tutor,
            'student_ID' => $student
        ])->latest()->get();

        return response()->json($mess);
    }

    public function writeMessage(Request $request)
    {
        $request->validate([
            'tutor_ID' => 'required',
            'student_ID' => 'required',
            'message_content' => 'required'
        ]);

        Message::create($request->all());
    }
}
