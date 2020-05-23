<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        //
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

/*

<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\CourseRepository;

class BlogController extends Controller
{
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


}

*/

/*

<?php namespace App\Http\Controllers;

use App\Course;
use App\Helpers\Page;
use App\Study;
use App\Helpers\UserRepository;
use Auth, Flash, Input, Redirect, stdClass;

class CoursesController extends Controller {

    protected $course;


    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->currentUser = Auth::user();
        
        $page = new Page;
        $page->make(new Course);
        
        $this->page = $page;
        
    }


    public function index()
    {
        $courses = Course::where('public','1')->paginate(9);
        $page = $this->page;

        return view('courses.index',compact('courses','page'));
    }
    
     public function show($course)
    {


        if($course->isPublic())
        {
            $page = new \stdclass;
            $page->title = $course->title;
            return view('courses.show', compact('course','page'));
        }
        
        request()->flash('message','Could not find that course!');
        
        return Redirect::to('/courses');
        
    }
    
    public function showByUser($username, $course)
    {
        if ($course === NULL ){return Redirect::to('/index?message=Sorry but we could not find that!');}
        
        $user = $this->userRepository->findByUsername($username);
        
        $lessons = $course->lessons()->published()->get();
                
        $mode = 'all';
    
        $collection = TRUE;
    
        // Show the page
        return view('users.courses.show-public', compact('course','lessons','title','mode','collection','meta','user'));
    }    
    
}


*/