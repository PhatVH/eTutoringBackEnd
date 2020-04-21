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
    public function register (Request $request) {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'password' => 'required|string|',
            'role' => 'required|string',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'
        ]);

        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $request['password']=Hash::make($request['password']);

        $userid = User::create([
            'username' => $request['username'],
            'password' => $request['password'],
            'role' => $request['role']
        ])->id;

        switch($request['role']){
            case 'student':
                $student = Student::create([
                    'student_name' => $request['name'],
                    'student_email' => $request['email'],
                    'student_phone' => $request['phone'],
                    'user_ID' => $userid
                ]);

                return response()->json([
                    'message' => 'Register successful',
                ]);
            case 'tutor':
                $tutor = Tutor::create([
                    'tutor_name' => $request['name'],
                    'tutor_email' => $request['email'],
                    'tutor_phone' => $request['phone'],
                    'user_ID' => $userid
                ]);

                return response()->json([
                    'message' => 'Register successful',
                ]);
            case 'staff':
                $staff = Staff::create([
                    'staff_name' => $request['name'],
                    'staff_email' => $request['email'],
                    'staff_phone' => $request['phone'],
                    'user_ID' => $userid
                ]);

                return response()->json([
                    'message' => 'Register successful',
                ]);
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

        if ($user) {

            if (Hash::check($request->password, $user->password)) {
                // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $role = $user->role;
                $userid = $user->id;
                switch($role){
                    case 'student':
                        $student = Student::where('user_ID', $userid)->first();
                        Student::where('user_ID', $userid)->update([
                            'lastLoggedIn' => now()
                        ]);

                        return response()->json($student);

                    case 'tutor':
                        $tutor = Tutor::where('user_ID', $userid)->first();

                        return response()->json($tutor);

                    case 'staff':
                        $staff = Staff::where('user_ID', $userid)->first();

                        return response()->json($staff);
                }
            } else {
                $response = "Password missmatch";
                return response($response, 422)->json();
            }

        } else {
            $response = 'User does not exist';
            return response($response, 422)->json();
        }
    }

    public function logout (Request $request) {

        $token = $request->user()->token();
        $token->revoke();

        $response = 'You have been succesfully logged out!';
        return response($response, 200);

    }
}
