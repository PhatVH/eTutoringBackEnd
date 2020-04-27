<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Staff;
use App\Student;
use App\Tutor;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
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

    public function register (Request $request) {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|',
            'role' => 'required|string',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'country' => 'required',
            'student_id' => 'nullable'
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password']=Hash::make($request['password']);

        switch($request['role']){
            case 'student':

                if($request['student_id'] != ''){
                    $userid = User::create([
                    'username' => $request['username'],
                    'password' => $request['password'],
                    'role' => $request['role'],
                    'country' => $request['country']
                    ])->id;

                    Student::create([
                        'student_ID' => $request['student_id'],
                        'student_name' => $request['name'],
                        'student_email' => $request['email'],
                        'student_phone' => $request['phone'],
                        'user_ID' => $userid
                    ]);

                    return response()->json([
                        'message' => 'Register successful',
                    ]);
                } else {
                    return response()->json('Missing param student_id when register with student role');
                }


                break;
            case 'tutor':

                $userid = User::create([
                    'username' => $request['username'],
                    'password' => $request['password'],
                    'role' => $request['role'],
                    'country' => $request['country']
                ])->id;

                Tutor::create([
                    'tutor_name' => $request['name'],
                    'tutor_email' => $request['email'],
                    'tutor_phone' => $request['phone'],
                    'user_ID' => $userid
                ]);

                return response()->json([
                    'message' => 'Register successful',
                ]);
                break;
            case 'staff':

                $userid = User::create([
                    'username' => $request['username'],
                    'password' => $request['password'],
                    'role' => $request['role'],
                    'country' => $request['country']
                ])->id;

                Staff::create([
                    'staff_name' => $request['name'],
                    'staff_email' => $request['email'],
                    'staff_phone' => $request['phone'],
                    'user_ID' => $userid
                ]);

                return response()->json([
                    'message' => 'Register successful',
                ]);
                break;
            default:
                    return response()->json([
                        'message' => 'Role unavailable'
                    ]);
        }



        // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = json_encode("Register successful");

        return response($response, 200);

    }

    public function login (Request $request) {

        $user = User::where('username', $request->username)->first();

        if($user) {
            if (Hash::check($request->password, $user->password)) {
                $role = $user->role;
                $userid = $user->id;
                $countryFlag = $this->getCountryFlag($user->country);
                switch($role){
                    case 'student':

                        $student = Student::where('user_ID', $userid)->first();
                        Student::where('user_ID', $userid)->update([
                            'lastLoggedIn' => now()
                        ]);

                        $tutorname = '';

                        if($student->tutor_ID != ''){
                            $tutorname = Tutor::where('id', $student->tutor_ID)->first()->tutor_name;
                        }

                        return response()->json([
                            'id' => $student->id,
                            'student_ID' => $student->student_ID,
                            'user_ID' => $userid,
                            'name' => $student->student_name,
                            'email' => $student->student_email,
                            'phone' => $student->student_phone,
                            'tutor_ID' => $student->tutor_ID,
                            'tutor_name' => $tutorname,
                            'lastLoggedIn' => $student->lastLoggedIn,
                            'type' => $user->role,
                            'country' => $user->country,
                            'country-flag' => $countryFlag
                        ]);
                        break;

                    case 'tutor':

                        $tutor = Tutor::where('user_ID', $userid)->first();

                        return response()->json([
                            'id' => $tutor->id,
                            'user_ID' => $userid,
                            'name' => $tutor->tutor_name,
                            'email' => $tutor->tutor_email,
                            'phone' => $tutor->tutor_phone,
                            'type' => $user->role,
                            'country' => $user->country,
                            'country-flag' => $countryFlag
                        ]);
                        break;

                    case 'staff':

                        $staff = Staff::where('user_ID', $userid)->first();

                        return response()->json([
                            'id' => $staff->id,
                            'user_ID' => $userid,
                            'name' => $staff->staff_name,
                            'email' => $staff->staff_email,
                            'phone' => $staff->staff_phone,
                            'type' => $user->role,
                            'country' => $user->country,
                            'country-flag' => $countryFlag
                        ]);
                        break;
                }
            } else {
                $response = "Password missmatch";
                return response()->json([
                    'message' => $response
                ],422);
            }

        } else {
            $response = 'User does not exist';
            return response()->json([
                'message' => $response
            ],422);
        }
    }

    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response($response, 200);

    }
}
