<?php

namespace App\Http\Controllers\Api;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Tutor;
use App\User;

class MeetingApiController extends Controller
{

    public function getNameFromId($id){
        $role = User::where('id', $id)->first();

        switch($role['role']){
            case 'tutor':
                $name = Tutor::where('user_ID', $id)->first();
                return $name['tutor_name'];
                break;
            case 'student':
                $name = Student::where('user_ID', $id)->first();
                return $name['student_name'];
                break;
            default:
                return 'No name';
                break;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $meetings = Meeting::all([
            'id',
            'host_ID',
            'start',
            'end',
            'title',
            'invite_ID'
        ]);

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

        return response()->json($meetings);
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
            'host_ID' => 'required',
            'start' => 'required',
            'end' => 'required',
            'title' => 'required',
            'invite_ID' => 'required'
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

        $meetings = Meeting::where('id', $request['id'])->get();

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

        return response()->json($meetings);
    }

    // public function showMyMeetings(Request $request)
    // {
    //     $request->validate([
    //         'id' => 'required'
    //     ]);

    //     $role = User::where('id', )

    //     // $meetings = Meeting::where('host', $request['id']);

    //     return response()->json([
    //         'schedule' => $meetings
    //     ]);
    // }

    public function showByInvite(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $meetings = Meeting::where('invite_ID', $request['id'])->get();

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

        return response()->json([
            'schedule' => $meetings
        ]);
    }

    public function showByHost(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $meetings = Meeting::where('host_ID', $request['id'])->get();

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

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
