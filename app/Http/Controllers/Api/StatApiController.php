<?php

namespace App\Http\Controllers\Api;

use App\chatContent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatApiController extends Controller
{
    public function messagesLast7Days()
    {

        for ($i = 0; $i < 7; $i++){
            $day = Carbon::now()->subDays($i)->toDateString();
            $chatsThisDay = chatContent::whereBetween('created_at', [$day . ' 00:00:00', $day . ' 23:59:59'])->count();
            $arr[] = $chatsThisDay;
        }

        return response()->json([
            'message' => 'success',
            'numberMess' => array_reverse($arr)
        ]);
    }

    public function tutorMessagesLast7Days(){

        $arr = array();
        for ($i = 0; $i < 7; $i++){
            $day = Carbon::now()->subDays($i)->toDateString();
            $chatsThisDay = DB::table('chat_contents')->whereBetween('chat_contents.created_at', [$day . ' 00:00:00', $day . ' 23:59:59'])
                ->join('tutors', 'chat_contents.sender', '=', 'tutors.user_ID')
                ->count();
            $arr[] = $chatsThisDay;
        }

        return response()->json([
            'message' => 'success',
            'numberMess' => array_reverse($arr)
        ]);
    }

    public function studentMessagesLast7Days(){

        $arr = array();
        for ($i = 0; $i < 7; $i++){
            $day = Carbon::now()->subDays($i)->toDateString();
            $chatsThisDay = DB::table('chat_contents')->whereBetween('chat_contents.created_at', [$day . ' 00:00:00', $day . ' 23:59:59'])
                ->join('students', 'chat_contents.sender', '=', 'students.user_ID')
                ->count();
            $arr[] = $chatsThisDay;
        }

        return response()->json([
            'message' => 'success',
            'numberMess' => array_reverse($arr)
        ]);
    }
}
