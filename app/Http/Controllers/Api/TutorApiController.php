<?php

namespace App\Http\Controllers\Api;

use App\Tutor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TutorApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tutors = Tutor::all(['tutor_name', 'tutor_phone', 'tutor_email']);

        return response()->json($tutors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tutor_name' => 'required',
            'tutor_phone' => 'required',
            'tutor_email' => 'required'
        ]);

        $tutor = Tutor::create($request->all());

        return response()->json([
            'message' => 'Tutor added',
            'tutor' => $tutor
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function show(Tutor $tutor)
    {
        return $tutor;
    }

    public function findTutorByName()
    {
        $name = request('tutor_name');

        $tutor = Tutor::where('tutor_name', 'ilike', '%' . $name . '%')->get();

        return response()->json($tutor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tutor $tutor)
    {
        $request->validate([
            'tutor_name' => 'nullable',
            'tutor_phone' => 'nullable',
            'tutor_email' => 'nullable'
        ]);

        $tutor->update($request->all());

        return response()->json([
            'message' => 'Updated tutor',
            'tutor' => $tutor
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tutor  $tutor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tutor $tutor)
    {
        $tutor->delete();

        return response()-json([
            'message' => 'Successfully delete Tutor'
        ]);
    }
}
