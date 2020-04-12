<?php namespace App\Http\Controllers\Bible;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BibleVerse;
use Illuminate\Http\Request;
use Auth, Flash, Input, Redirect, Session, stdClass, Str;

class PlanMakerController extends Controller {
	
	function __construct(){
		$this->middleware('auth');
		$this->currentUser = Auth::user();
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//Haven't finished database migration file yet,
		//still figuring how to go about this
		
		$userPlans = $this->currentUser->readingPlans()->orderBy('updated_at','DESC')->paginate(9);
		$page = new stdClass();
		$page->title = 'Plan Maker ('.$userPlans->total().')';
		
		$form = new stdClass();
		$form->title = '';
		$form->description = '';
		
		return view('plan-maker.index',compact('userPlans','page','form'));
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
		$course->user_id = $this->currentUser->id;
		$course->save();
		
		request()->session('message','You can now build your course.');
		
		return Redirect::to($course->editUrl());
	}
	
	public function storeSection($course_uuid){

		$title = request('title');
		$description = request('description');
	
		$course = Course::where('uuid', $course_uuid)->first();
		$orderBy = $course->sections->count() + 1;
		
		$course->sections()->create([
				'title'=> $title,
				'description'=> $description,
				'orderBy'=> $orderBy
		]);
		
		request()->session('message','Section Created.');
	
		return Redirect::to($course->editUrl());
	}
	

	public function storeTask($course_uuid, $section_id){
		
		$type = request('task_type');
		
		$section = Section::find($section_id);
		
		$orderBy = $section->tasks->count() + 1;
		
		$section->tasks()->create([
				'task_type_id'=> $type,
				'orderBy'=> $orderBy
		]);
		
		request()->session('message','Task Created.');
	
		return Redirect::back();
	}
	
	public function editTask($course_uuid, $section_id, $task_id){
		
		$course = Course::where('uuid',$course_uuid)->first();
		
		$task = Task::find($task_id);
		$task = $task->buildEditor();
		
		$page = new stdClass();
		$page->title = 'Builder';
		
		return view($task->templates->edit, compact('task','page','course'));
		
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
	public function edit($uuid)
	{
		$course = Course::where('uuid',$uuid)->first();
		
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
	public function update($uuid)
	{
		
		$course = Course::where('uuid',$uuid)->update([
			'title'=> request('title'),
			'description'=> request('description'),
		]);
		
		request()->session('message','Your changes were saved.');
		
		return Redirect::back();
	}
	
	public function updateImage(UpdateCourseImageRequest $request, $uuid){
		
		$course = Course::where('uuid',$uuid)->first();

		$image_id = Image::upload(request()->file('file'), $course, $this->currentUser);

		$course->image_id = $image_id;
		$course->save();
		
		request()->session('message','Image updated.');
		
		return Redirect::to($course->editUrl());
	}
	
	public function updateSection($uuid, $section_id)
	{
	
		$section = Section::find($section_id)->update([
				'title'=> request('title'),
				'description'=> request('description'),
		]);
	
		request()->session('message','Your changes were saved.');
	
		return Redirect::back();
	}
	
	public function updateTask($uuid, $section_id, $task_id)
	{
	
		$task = Task::find($task_id)->update([
				'title'=> request('title'),
				'instructions'=> request('instructions'),
				'points'=>request('points')
		]);
	
		request()->session('message','Your changes were saved.');
	
		return Redirect::back();
	}
	
	public function attachTaskProperty(){
	
		TaskProperty::taskThis(
				request('task'), 
				request('object_class'), 
				request('object_id')
				);
		
		request()->session('message','New property successfuly added.');
		
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
