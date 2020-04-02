<?php namespace App\Http\Controllers\Bible;

use App\Course;
use App\Page;
use App\Study;
use App\UserRepository;
use Auth, Flash, Input, Redirect, stdClass;

class CoursesController extends Controller {

    /**
     * Course Model
     * @var Course
     */
    protected $course;

    /**
     * Inject the models.
     * @param Course $course
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->currentUser = Auth::user();
        
        $page = new Page;
        $page->make(new Course);
        
        $this->page = $page;
        
    }

    /**
     * Users settings page
     *
     * @return View
     */
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
    	    return view('courses.show', compact('course'));
        }
        
        Flash::message('Could not find that course!');
        
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
