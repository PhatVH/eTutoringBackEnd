<?php

namespace App\Http\Controllers\Api;

use App\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Log;
use App\Tutor;
use App\User;
use Carbon\Carbon;

class StudentApiController extends Controller
{

    public function getCountryFlag($country){
        switch(strtolower($country)){
            case 'canada':
                return 'c/cf/Flag_of_Canada.svg';
                break;
            case 'russia':
                return 'f/f3/Flag_of_Russia.svg';
                break;
            case 'france':
                return 'c/c3/Flag_of_France.svg';
                break;
            case 'vietnam':
                return '2/21/Flag_of_Vietnam.svg';
                break;
            default:
                return 'No flag';
                break;
        }
    }

    public function doLog($id, $content){
        Log::create([
            'user_ID' => $id,
            'log_content' => $content
        ]);
    }

    public function addInfo($students){
        foreach($students as $student){
            if($student->tutor_ID != ''){
                $tutorname = Tutor::where('id', $student->tutor_ID)->first();
                $student->tutor_name = $tutorname['tutor_name'];
            }

            $country = User::where('id', $student->user_ID)->first();
            $student->country = $country['country'];
            $student->countryFlag = $this->getCountryFlag($country['country']);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $name = Request('name_like');

        $students = Student::where('student_name', 'ilike', '%' . $name . '%')
                ->orderBy('student_name')
                ->get([
                'id',
                'student_ID',
                'user_ID',
                'student_name as name',
                'student_email as email',
                'student_phone as phone',
                'tutor_ID'
            ]);

        $this->addInfo($students);

        return response()->json($students);

    }

    public function indexByTutor(Request $request)
    {

        $students = Student::where('tutor_ID', $request->input('tutor_ID'));


        if($request->has('name_like')){
            $students = $students->where('student_name', 'ilike', '%' . $request->input('name_like') . '%');
        }

        $students = $students->orderBy('student_name')
            ->get([
            'id',
            'student_ID',
            'user_ID',
            'student_name as name',
            'student_email as email',
            'student_phone as phone',
            'tutor_ID'
            ]);

        $this->addInfo($students);

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

    public function setPersonalTutor(Request $request)
    {

        $tutorid = request('tutor_id');

        $students = request('student_id');

        foreach($students as $student){

            //Get student info
            $stu = Student::where('id', $student)->first();
            //Update tutor
            Student::where('id', $student)->update(['tutor_ID' => $tutorid]);

            //Logging
            $tut = Tutor::where('id', $tutorid)->first();

            //If tutor exist (allocating tutor)
            if($tut){
                //Get tutor info
                $tut = Tutor::where('id', $tutorid)->first();

                //Log for student
                $this->doLog($stu['user_ID'],
                    'You have been alocated to Tutor ' . $tut['tutor_name']);

                //Log for tutor
                $this->doLog($tut['user_ID'],
                    'You have been allocated to Student ' . $stu['student_name']);
            } else { //If tutor not exist (unallocating tutor)
                //If student is having a tutor
                if($stu['tutor_ID'] != ''){

                    //Get current tutor info
                    $tu = Tutor::where('id', $stu['tutor_ID'])->first();

                    //Log for tutor
                    $this->doLog($tu['user_ID'],
                        'You have been unallocated from Student ' . $stu['student_name']);

                    //Log for student
                    $this->doLog($stu['user_ID'],
                        'You have been unallocated from Tutor ' . $tu['tutor_name']);

                }
            }
        }

        return response()->json([
            'message' => 'Set tutor successful'
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
        $students = Student::whereDate('lastLoggedIn', '<', $loginDate)->get([
            'id',
            'student_ID',
            'user_ID',
            'student_name as name',
            'student_email as email',
            'student_phone as phone',
            'tutor_ID'
        ]);

        $this->addInfo($students);

        return response()->json($students);
    }

    public function studentsWithoutTutor(Request $request)
    {
        $students = Student::whereNull('tutor_ID');

        if($request->has('name_like')){
            $students = $students->where('student_name', 'ilike', '%' . $request->input('name_like') . '%');
        }

        $students = $students->get([
            'id',
            'student_ID',
            'user_ID',
            'student_name as name',
            'student_email as email',
            'student_phone as phone'
        ]);

        foreach($students as $student){

            $country = User::where('id', $student->user_ID)->first();
            $student->country = $country['country'];
            $student->countryFlag = $this->getCountryFlag($country['country']);
        }

        return response()->json($students);
    }

    public function getTutor(Request $request){

        $studentid = Student::where('id', request('student_id'))->first();

        $tutor = Tutor::where('id', $studentid['tutor_ID'])->get([
            'id',
            'user_ID',
            'tutor_name as name',
            'tutor_phone as phone',
            'tutor_email as email'
        ]);

        foreach($tutor as $tut){

            $country = User::where('id', $tut['user_ID'])->first();
            $tut->country = $country['country'];
            $tut->countryFlag = $this->getCountryFlag($country['country']);
        }

        return response()->json($tutor);
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
