<?php

namespace App\Http\Controllers\Api;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MeetingApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = Meeting::all([
            'id',
            'host',
            'start',
            'end',
            'title',
            'invite'
        ]);

        return response()->json([
            'schedule' => $meetings
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validation([
            'host' => 'required',
            'start' => 'required',
            'end' => 'required',
            'title' => 'required',
            'invite' => 'required'
        ]);

        $meeting = Meeting::create($request->all());

        return response()->json([
            'message' => 'Add meeting successful',
            'meeting' => $meeting
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $meeting = Meeting::where('id', $request['id']);

        return response()->json([
            'schedule' => $meeting
        ]);
    }

    public function showByHost(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $meetings = Meeting::where('host', $request['id']);

        return response()->json([
            'schedule' => $meetings
        ]);
    }

    public function showByInvite(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $meetings = Meeting::where('invite', $request['id']);

        return response()->json([
            'schedule' => $meetings
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Meeting::where('id', request('id'))->delete();

        return response()->json([
            'message' => 'Delete successful'
        ]);
    }
}
