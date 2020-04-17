<?php

namespace App\Http\Controllers\Api;

use App\Staff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();

        return response()->json($staff);
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
            'authorisedStaff_name' => 'required',
            'authorisedStaff_email' => 'required',
            'authorisedStaff_phone' => 'required'
        ]);

        $staff = Staff::create($request->all());

        return response()->json([
            'message' => 'Staff created!',
            'staff' => $staff
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $staff = Staff::where('id', request('id'))->get();

        return $staff;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        Staff::where('id', response('id'))->delete();

        return response()->json([
            'message' => 'Delete staff successful'
        ]);
    }
}
