<?php

namespace App\Http\Controllers\Api;

use App\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $document = Document::all([
            'id',
            'student_ID',
            'tutor_ID',
            'document_name'
        ]);

        return response()->json($document);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveTutorDocument(Request $request)
    {
        $request->validate([
            'tutor_ID' => 'required',
            'document_name' => 'required'
        ]);

        $document = Document::create($request->all());

        return response()->json([
            'message' => 'New Tutor document added',
            'document' => $document
        ]);
    }

    public function saveStudentDocument(Request $request)
    {
        $request->validate([
            'student_ID' => 'required',
            'document_name' => 'required'
        ]);

        $document = Document::create($request->all());

        return response()->json([
            'message' => 'New Student document added',
            'document' => $document
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = request('id');

        $document = Document::where('id', $id)->get();

        return $document;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = request('id');

        Document::where('id', $id)->delete();

        return response()->json([
            'message' => 'Delete successful'
        ]);
    }
}
