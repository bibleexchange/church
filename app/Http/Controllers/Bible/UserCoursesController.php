<?php namespace App\Http\Controllers\Bible;

use App\Http\Requests;
use App\Bible\Requests\CreateCourseRequest;
use App\Bible\Commands\CreateCourseCommand;
use App\Http\Controllers\Controller;
use Input, Auth, Str, Flash, Redirect;
use App\UserRepository;
use Illuminate\Http\Request;

class UserCoursesController extends Controller {
	
	function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}
	
	public function index($username)
	{
		$user = $this->userRepository->findByUsername($username);
	
		$courses = $user->courses()->public()->paginate(9);
	
		return view('users.courses.index-public',compact('courses','user'));
	}

}
