<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\CourseRepository;

class BlogController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = new CourseRepository;
		$posts = $posts->all();

        return view('blog.index', compact('posts') );
    }

    public function tagIndex($tag)
    {
        $posts = new CourseRepository;
		$posts = $posts->where("tag","===",$tag);
        return view('blog.index', compact('posts') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($courseId)
    {
        $posts = new CourseRepository;
		$course = $posts->first($courseId);

        return view('blog.course', compact('course') );
    }

    public function lesson($courseId, $lessonId)
    {
        $posts = new CourseRepository;
		$course = $posts->first($courseId);
        $lesson = $posts->lesson($courseId, $lessonId);

        return view('blog.show', compact('course','lesson') );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
