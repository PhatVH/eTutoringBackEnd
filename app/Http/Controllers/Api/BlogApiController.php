<?php

namespace App\Http\Controllers\Api;

use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::all();

        return response()->json($blog);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveStudentBlog(Request $request)
    {
        $request->validate([
            'student_ID' => 'required',
            'blog_title' => 'required',
            'blog_content' => 'required'
        ]);

        $blog = Blog::create($request->all());

        return response()->json([
            'message' => 'New Student blog added',
            'blog' => $blog
        ]);
    }

    public function saveTutorBlog(Request $request)
    {
        $request->validate([
            'tutor_ID' => 'required',
            'blog_title' => 'required',
            'blog_content' => 'required'
        ]);

        $blog = Blog::create($request->all());

        return response()->json([
            'message' => 'New Tutor blog added',
            'blog' => $blog
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function showStudentBlog()
    {
        $studentId = request('student_ID');

        $blog = Blog::where('student_ID', $studentId)->get();

        return json([
            'blogs' => $blog
        ]);
    }

    public function showTutorBlog()
    {
        $studentId = request('tutor_ID');

        $blog = Blog::where('tutor_ID', $studentId)->get();

        return json([
            'blogs' => $blog
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        $id = request('blog_ID');

        Blog::where('id', $id)->delete();

        return response()->json([
            'message' => 'Successfully delete Blog'
        ]);
    }
}
