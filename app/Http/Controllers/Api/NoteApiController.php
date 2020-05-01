<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Note;

class NoteApiController extends Controller
{
    public function addNote(Request $request)
    {
        Note::create([
            'user_ID' => $request['user_id'],
            'title' => $request['title'],
            'content' => $request['content']
        ]);

        return response()->json([
            'message' => 'Add note successful'
        ]);
    }

    public function viewNotes(Request $request)
    {
        $notes = Note::where('user_ID', $request['user_id'])->get();

        return response()->json($notes);
    }
}
