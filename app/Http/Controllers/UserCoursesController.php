<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Requests\CreateCourseRequest;
use App\Commands\CreateCourseCommand;
use App\Http\Controllers\Controller;
use Input, Auth, Str, Flash, Redirect;
use App\Helpers\UserRepository;
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
