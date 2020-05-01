<?php

namespace App\Http\Controllers\Api;

use App\Meeting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MeetingNote;
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

    public function studentCreateMeeting(Request $request){
        $request->validate([
            'host_ID' => 'required',
            'start' => 'required',
            'end' => 'required',
            'title' => 'required',
        ]);

        $student = Student::where('user_ID', $request['host_ID'])->first();

        if($student['tutor_ID'] != ''){
            $tutor = Tutor::where('id', $student['tutor_ID'])->first();

            $meeting = Meeting::create([
                'host_ID' => $request['host_ID'],
                'start' => $request['start'],
                'end' => $request['end'],
                'title' => $request['title'],
                'invite_ID' => $tutor['user_ID']
            ]);

            return response()->json([
                'message' => 'Add meeting successful',
                'meeting' => $meeting
            ]);
        } else {
            return response()->json('This student does not have a tutor');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Meeting  $meeting
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $meetings = Meeting::where('id', $request['id'])->get();

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

        return response()->json($meetings);
    }

    public function showById(Request $request)
    {

        $meetings = Meeting::where('host_ID', $request['user_id'])
            ->orWhere('invite_ID', $request['user_id'])->get();

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

        return response()->json($meetings);
    }

    public function showByInvite(Request $request)
    {

        $meetings = Meeting::where('invite_ID', $request['user_id'])->get();

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

        return response()->json($meetings);
    }

    public function showByHost(Request $request)
    {

        $meetings = Meeting::where('host_ID', $request['user_id'])->get();

        foreach ($meetings as $meeting){
            $meeting->host = $this->getNameFromId($meeting['host_ID']);
            $meeting->invite = $this->getNameFromId($meeting['invite_ID']);
        }

        return response()->json($meetings);
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
