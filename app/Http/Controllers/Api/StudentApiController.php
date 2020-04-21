<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tutor;
use Carbon\Carbon;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Student::where('student_name', 'ilike', '%' . request('name_like') . '%')
            ->orderBy('student_name')
            ->get([
            'id',
            'student_name as name',
            'student_email as email',
            'student_phone as phone',
            'tutor_ID'
        ]);

        foreach($students as $student){
            if($student->tutor_ID != ''){
                $tutorname = Tutor::where('id', $student->tutor_ID)->first();
                $student->tutor_name = $tutorname['tutor_name'];
            }
        }

        return response()->json($students);
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
            'student_name' => 'required',
            'student_email' => 'required',
            'student_phone' => 'required'
        ]);

        $student = Student::create($request->all());

        return response()->json([
            'message' => 'Create student successful',
            'student' => $student
        ]);
    }

    public function setPersonalTutor()
    {

        $tutorid = request('tutor_id');

        $student = Student::where('id', request('id'))->update(['tutor_ID'=> $tutorid]);

        return response()->json([
            'message' => 'Set tutor successful',
            'student' => $student
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $student = Student::where('id', request('id'))->get();

        return $student;
    }

    public function findStudentByName()
    {
        $students = Student::where('student_name', 'ilike', '%' . request('name') . '$')->get([
            'id',
            'student_name',
            'student_email',
            'student_phone'
        ]);

        return response()->json($students);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'nullable',
            'student_name' => 'nullable',
            'student_phone' => 'nullable',
            'student_email' => 'nullable'
        ]);

        $student = Student::where('id', request('id'))->update([
            'student_name' => $request->input('student_name'),
            'student_phone' => $request->input('student_phone'),
            'student_email' => $request->input('student_email')
        ]);

        return response()->json([
            'message' => 'Successfully update student',
            'student' => $student
        ]);
    }

    public function studentsWithNoInteraction(Request $request)
    {
        $loginDate = Carbon::now()->subDays(7);
        $students = Student::whereDate('lastLoggedIn', '>', $loginDate)->get([
            'id',
            'student_name as name',
            'student_email as email',
            'student_phone as phone',
            'tutor_ID'
        ]);

        return response()->json($students);
    }

    public function studentsWithoutTutor(Request $request)
    {
        $students = Student::whereNull('tutor_ID')->get([
            'id',
            'student_name as name',
            'student_email as email',
            'student_phone as phone'
        ]);

        return response()->json($students);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Student::where('id', request('id'))->delete();

        return response()->json([
            'message' => 'Successfully delete student'
        ]);
    }
}
