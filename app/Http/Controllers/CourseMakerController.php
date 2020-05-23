<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Requests\UpdateCourseImageRequest;
use App\Course;
use App\Image;
use App\Section;
use App\Task;
use App\TaskProperty;
use App\TaskType;

use Illuminate\Http\Request;
use Auth, Flash, Input, Redirect, Session, stdClass, Str;

class CourseMakerController extends Controller {
	
	function __construct(){
		$this->middleware('auth');
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$userCourses = Auth::user()->courses()->orderBy('updated_at','DESC')->paginate(12);
		$page = new stdClass();
		$page->title = 'Course Maker ('.$userCourses->total().')';
		
		$form = new stdClass();
		$form->title = '';
		$form->description = '';
		
		return view('course-maker.index',compact('userCourses','page','form'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$title = request('title');
		$description = request('description');
		
		$uuid = Str::random(10);
		
		if (Course::where('uuid')->get()->count() > 0){
			$uuid = Str::random(10);
		}
		
		$course = new Course;
		$course->uuid = $uuid;
		$course->title = $title;
		$course->description = $description;
		$course->user_id = Auth::user()->id;
		$course->save();
		
		request()->session('message','You can now build your course.');
		
		return Redirect::to($course->editUrl());
	}
	
	public function storeSection($course){

		$title = request('title');
		$description = request('description');
	
		$orderBy = $course->sections->count() + 1;
		
		$course->sections()->create([
				'title'=> $title,
				'description'=> $description,
				'orderBy'=> $orderBy
		]);
		
		request()->session('message','Section Created.');
	
		return Redirect::to($course->editUrl());
	}
	

	
	
	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($course)
	{
		
		if( ! $course){
			
			request()->session('error','Course doesn\'t exist.');
			
			return Redirect::to('/user/course-maker');
		}
		
		
		Session::put('last_edited_course_id',$course->id);
		
		$page = new stdClass();
		$page->title = 'Editing Course: "'.$course->title.'"';
		
		$form = new stdClass();
		$form->title = $course->title;
		$form->description = $course->description;
		$form->existing_image_id = null;
		
		$task_types = TaskType::get()->pluck('name','id');
		
		return view('course-maker.edit', compact('course','form','page','task_types'));
	}
	
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($course)
	{

		$course->update([
			'title'=> request('title'),
			'description'=> request('description'),
		]);
		
		request()->session('message','Your changes were saved.');
		
		return Redirect::back();
	}
	
	public function updateImage(UpdateCourseImageRequest $request, $uuid){
		
		$course = Course::where('uuid',$uuid)->first();

		$image_id = Image::upload(request()->file('file'), $course, Auth::user());

		$course->image_id = $image_id;
		$course->save();
		
		request()->session('message','Image updated.');
		
		return Redirect::to($course->editUrl());
	}
	
	public function updateSection($course, $section)
	{

	    $section->update([
				'title'=> request('title'),
				'description'=> request('description'),
		]);
	
		request()->session('message','Your changes were saved.');
	
		return Redirect::back();
	}
	
	public function attachStudy($course, $section)
	{
		
		$orderBy = $section->studies->count() + 1;
		
		$section->studies()->attach(request('study'),['orderBy' => $orderBy]);
	
		request()->session('message','Study was added to Section.');
	
		return Redirect::back();
	}
	
	public function publish($course)
	{
	
		$course->publish();
		$course->save();
	
		return Redirect::back();
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}	
}
