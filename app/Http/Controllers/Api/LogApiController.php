<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Log;

class LogApiController extends Controller
{
    public function index(Request $request)
    {
        $logs = Log::where('user_ID', $request['user_id'])->get([
            'log_content as content',
            'created_at as time'
        ]);

        return response()->json($logs);
    }
}
