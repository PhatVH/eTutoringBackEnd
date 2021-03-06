<?php

namespace App\Http\Controllers\Api;

use App\Tutor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class TutorApiController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tutors = Tutor::where('tutor_name', 'ilike', '%' . Request('name_like') . '%')->orderBy('tutor_name')->get([
            'id',
            'user_ID',
            'tutor_name as name',
            'tutor_phone as phone',
            'tutor_email as email'
        ]);

        foreach($tutors as $tutor){
            $country = User::where('id', $tutor->user_ID)->first();
            $tutor->country = $country['country'];
            $tutor->countryFlag = $this->getCountryFlag($country['country']);
        }

        // foreach($tutors as $tutor){
        //     $n = 1;
        //     $tutor->testing = $n;
        //     $n++;
        // }

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

        $tutor = Tutor::create($request->all())->id;

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
    public function show()
    {
        $tutor = Tutor::where('id', request('id'))->get([
            'id',
            'tutor_name as name',
            'tutor_phone as phone',
            'tutor_email as email'
        ]);

        return $tutor;
    }

    public function findTutorByName()
    {
        $name = request('name');

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
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'tutor_name' => 'nullable',
            'tutor_phone' => 'nullable',
            'tutor_email' => 'nullable'
        ]);

        $tutor = Tutor::where('id', $request->input('id'))->update([
            'tutor_name' => $request->input('tutor_name'),
            'tutor_phone' => $request->input('tutor_phone'),
            'tutor_email' => $request->input('tutor_email')
        ]);

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
