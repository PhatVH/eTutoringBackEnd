<?php

namespace App\Http\Controllers\Api;

use App\Chat;
use App\chatContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatApiController extends Controller
{
    public function getAllMessage(Request $request)
    {
        $chat = Chat::where([
            'student_user_id' => $request['student_user_id'],
            'tutor_user_id' => $request['tutor_user_id']
        ])->first();

        if($chat){
            $contents = chatContent::where('chat_ID', $chat['id'])
            ->orderBy('created_at')
            ->get([
            'chat_ID as chat_id',
            'sender as user_id',
            'content'
            ]);

            return response()->json([
                'chat_id' => $chat['id'],
                'chat' => $contents
            ]);
        } else {
            $chatid = Chat::create([
                'student_user_id' => $request['student_user_id'],
                'tutor_user_id' => $request['tutor_user_id']
            ])->id;

            return response()->json(['chat_id' => $chatid]);
        }

    }

    public function sendMessage(Request $request){
        $chat = Chat::where('id', $request['chat_id'])->first();

        if($chat){
            $content = chatContent::create([
                'chat_ID' => $chat['id'],
                'sender' => $request['user_id'],
                'content' => $request['content']
            ]);

            return response()->json($content);
        } else{
            $chatid = Chat::create([
                'student_user_id' => $request['student_user_id'],
                'tutor_user_id' => $request['tutor_user_id']
            ])->id;

            $content = chatContent::create([
                'chat_ID' => $chatid,
                'sender' => $request['user_id'],
                'content' => $request['content']
            ]);

            return response()->json($content);
        }
    }
}
