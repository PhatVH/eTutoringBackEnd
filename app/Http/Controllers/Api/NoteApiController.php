<?php

namespace App\Http\Controllers\Api;

use App\Note;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NoteApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = Note::all();

        return response()->json($notes);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addStudentNote(Request $request)
    {
        $request->validate([
            'student_ID' => 'required',
            'note_content' => 'required'
        ]);

        $note = Note::create($request->all());

        return response()->json([
            'message' => 'Add student note successful',
            'note' => $note
        ]);
    }

    public function addTutorNote(Request $request)
    {
        $request->validate([
            'note_content' => 'required',
            'tutor_ID' => 'required'
        ]);

        $note = Note::create($request->all());

        return response()->json([
            'message' => 'Add tutor note successful',
            'note' => $note
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return Note::where('id', Request('id'))->get();
    }

    public function showStudentNotes()
    {
        $note = Note::where('student_ID', request('student_ID'))->get();

        return response()->json($note);
    }

    public function showTutorNotes()
    {
        $note = Note::where('tutor_ID', request('tutor_ID'))->get();

        return response()->json($note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        Note::where('id', request('id'))->delete();

        return response()->json([
            'message' => 'Delete note successful'
        ]);
    }
}
