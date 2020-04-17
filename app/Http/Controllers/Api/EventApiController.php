<?php

namespace App\Http\Controllers\Api;

use App\event;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EventApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = event::all();

        return response()->json($events);
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
            'event_title' => 'required',
            'event_description' => 'required',
            'event_date_start' => 'required'
        ]);

        $event = event::create($request->all());

        return response()->json([
            'message' => 'Event created',
            'event' => $event
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id = request('id');

        $event = event::where('id', $id)->get();

        return $event;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(event $event)
    {
        $id = request('id');

        event::where('id', $id)->delete();

        return response()->json([
            'message' => 'Successfully delete event'
        ]);
    }
}
