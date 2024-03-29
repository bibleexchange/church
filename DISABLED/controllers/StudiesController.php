<?php namespace App\Http\Controllers\Bible;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BibleBook;
use App\BibleVerse;
use App\BibleHighlight;
use App\Course;
use App\Image;
use App\Page;
use App\Lesson;
use App\Study;
use App\StudyFetcher;
use App\Task;
use App\TaskProperty;
use App\TaskType;
use App\UserRepository;
use App\Bible\Requests\CreateBEStudyRequest;
use App\Bible\Requests\UpdateBEStudyRequest;
use App\Bible\Requests\UploadMarkdownRequest;
use App\Bible\Commands\CreateBEStudyCommand;
use App\Bible\Commands\UpdateBEStudyCommand;
use App\Bible\Helpers\Helpers as Helper;
use Illuminate\Http\Request;
use Auth, View, Input, Flash, Redirect, Session, stdClass; 
use Illuminate\Pagination\LengthAwarePaginator;
use App\Helpers\Parsedown;

class StudiesController extends Controller {
	
	function __construct(UserRepository $userRepository){
		
		$this->middleware('be.editor', ['except' => ['index','show','studySpace','showTag','goToStudy','userIndex','create','store','uploadTextFile']]);
		$this->middleware('auth', ['only' => ['create','store','uploadTextFile']]);

        $this->middleware('be.updateStudy', ['only'=>['update']]);

		if(\Route::current() !== null){
			$path_array = \Route::current()->parameters();
		}else{
			$path_array = [];
		}
       
		$fetch = new StudyFetcher($path_array);
 
		$page = new Page;

		$page->make($fetch->study);

		$this->page = $page;
		$this->study = $fetch->study;
		
		$this->pathArray = $path_array;
		$this->userRepository = $userRepository;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$page = $this->page;
    
		$study = $this->study;
		$studies = Study::orderBy('updated_at', 'DESC')->public()->paginate(9);
		$courses = Course::where('public','1')->get();
		
		return view('studies.index',compact('page','study','studies','courses'));
	}
	
	public function userIndex($username)
	{
		$user = $this->userRepository->findByUsername($username);

		$studies = $user->studies()->public()->paginate(9);

		return view('users.studies.index-public',compact('studies','user'));
	}
	
	public function create()
	{
	
		$page = $this->page;
		$study = $this->study;
		$creating = true;
	
		$form = new \stdClass();
		$form->title = $study->title;
		$form->body = null;
		$form->comment = null;
		$form->description = null;
	
		if(old('text') !== null){
				
			$form->body = old('text');
			$form->title = old('title');
			$form->comment = old('comment');
			$form->description = old('description');
				
		}else if (\Session::has('body')){
				
			$file_array = explode('=@',\Session::get('body'));
				
			if(count($file_array) >= 2){
	
				foreach($file_array AS $b){
					$temp = explode(':', $b,2);
						
					if(isset($temp[1])){
						$index = $temp[0];
						$content = $temp[1];
						$form->$index = $content;
					}
						
				}
	
			}else{
				$form->body = \Session::get('body');
			}
				
		}
	
		return view('studies.create',compact('page','study','creating','form'));
	
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(CreateBEStudyRequest $request)
	{

		$description = request('description');
		$title = request('title');
		$text = request('text');
		$comment = request('comment');
		$minor_edit = request('minor_edit');
		
		$study = $this->dispatch(new CreateBEStudyCommand($description,$title,Auth::user()->id, $text, $comment, $minor_edit));
		 
		request()->session('message','This study has begun!');
		
		return Redirect::to($study->editUrl());
		
	}
	
	public function uploadTextFile(UploadMarkdownRequest $request)
	{
		
	  	$file = request()->file('file');
	  
	  	if ($file->isValid()){
	  		
	  		$destinationPath = public_path().'/uploads'; // upload path
		    $extension = request()->file('file')->getClientOriginalExtension(); // getting image extension
		    $fileName = rand(11111,99999).'.'.$extension; // renameing image
		    
		    $file->move($destinationPath, $fileName); // uploading file to given path
		     
		    request()->session('message','Uploaded successfully'); 
		    
		    return Redirect::back()->with('body',file_get_contents(public_path().'/uploads/'.$fileName));
	  	}
	  	
	  	request()->session('error','File couldn\'t be uploaded');
	  	
	  	return Redirect::back();

	}
	
	public function studySpace(Request $request, $study,$titleSlug=false)
	{

        if($titleSlug === false){
            request()->session()->flash('message', 'I could not find that study!');

            return redirect('/study');
        }

   
		//Session::forget('recent_chapters');
		$bible = false;
		$booksOftheBible = [];
		$currentReference = null;
		$chapter = false;
        $recent_chapters = [];

		if(isset($_GET['bible'])){
			$currentReference = $_GET['bible'];			
		}
		
		if($currentReference !== null){
			
			$chapter = BibleVerse::isValidReference($currentReference)->chapter;
			$booksOftheBible = BibleBook::all();
			$recent_chapters = [null];
			
			if($chapter !== false){
				$bible = true;
				$currentReference = $chapter->reference;
				
				//create an array in session to keep track of reading record
				//up to last 10
				/*
				if(Session::get('recent_chapters') !== null)
				{
				
					$array[] = array_flatten(Session::get('recent_chapters'));

				}else {
					$array = [];
				}	
							
				$recent_chapters = array_push($array[0],$chapter->id);
				
				\Session::put('recent_chapters', $array[0]);
				*/
			}
			
		}
		
		$page = $this->page;
		$study = $this->study;
		
		$highlight_colors = BibleHighlight::getColors();
		
		if ($study->exists && $study->isPublic()){
			
			$page->title = $study->present()->title;
			$article = $study->published_html;

		}else{
			
			$study = new Study;
			$article = '';
			request()->session()->flash('message', 'I could not find that study!');
		}

		return view('studies.show',compact('article','page','study', 'bible','chapter','highlight_colors','currentReference','booksOftheBible','recent_chapters'));
		
	}
	
	public function showTag($tag)
	{
		
		$page = $this->page;
		
		
		$study = $this->study;
		
		$similarStudies = Study::whereHas('tags', function($q) use ($tag)
							{
							    $q->where('name', 'like', $tag.'%');
							
							})->paginate(6);
	
		if(empty($similarStudies)){
				
			request()->flash('message','No public studies match your request.');
		}
		
		$page->title = '(' . $similarStudies->total() . ') Studies Tagged "'. $page->title .'"';
		
		return view('studies.tagged',compact('page','study','similarStudies', 'tag'));
	
	}
	
	public function preview()
	{
	
		$page = $this->page;
		$study = $this->study;
	
		if ($study->exists){
			$page->title = '[PREVIEW] '.$study->present()->title;
			
			$article = nl2br(Parsedown::html($study->text()->text));
			
			return view('studies.preview',compact('article','page','study'));
		}
	}
	
	public function goToStudy(){
	
		$query = $_POST['query'];
		
		if($query !== ""){
		
			return \Redirect::to(Helper::userTitletoUrl($query));
		} else {
			
			return \Redirect::to('/study');
		}
	
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($study)
	{
		
		$page = $this->page;
		$study = $this->study;
		Session::put('last_edited_study_id',$study->id);
		$study_tags_string = Helper::arrayToCommaString($study->tags);
		
		$task_types = TaskType::where('name','test')->get()->pluck('name','id');
		
		$form = new \stdClass();
		$form->title = $page->title;
		
		if($study->text() === null){
			$form->body = null;
		} else {
			$form->body = $study->text()->text;
		}
		$form->comment = $study->comment;
		$form->description = $study->description;
		
		if(old('text') !== null){
				
			$form->body = old('text');
			$form->comment = old('comment');
			$form->description = old('description');
				
		}else if (\Session::has('body')){
				
			$file_array = explode('=@',\Session::get('body'));
				
			if(count($file_array) >= 2){
				
				$exclude_these = ['description','title'];
				
				foreach($file_array AS $b){
					$temp = explode(':', $b,2);
						
					if(isset($temp[1]) && ! in_array($temp[0],$exclude_these)){
						$index = $temp[0];
						$content = $temp[1];
						$form->$index = $content;
					}
						
				}
		
			}else{
				$form->body = \Session::get('body');
			}
				
		}

		return view('studies.edit',compact('page','study','form','study_tags_string','task_types'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update(Request $request)
	{

		$study = $this->study;
		
        \App\Jobs\UpdateStudyJob::dispatch($study, $request->all());

		request()->session('message','Your changes were saved!');
		
		return \Redirect::back();
	}
	
	public function updateTitle(){
	
		$study = $this->study;
		$study->title= Helper::userTitleToUrl(request('title'));
	
		if($study->title !== null){
			$study->save();
			request()->session('message','Your changes were saved!');
			return Redirect::to($study->url());
		} else {
			request()->session('error','your change could not be saved!');
			return Redirect::back();
		}
	
		
	}
	
	public function updateMainVerse(){
		
		$study = $this->study;
		$study->main_verse = BibleVerse::referenceTranslator(request('main_verse'))[0];
		
		if($study->main_verse !== null){
			$study->save();
			request()->session('message','Your changes were saved!');
		} else {
			request()->session('error','not a valid Scripture reference!');
		}
		
		return Redirect::back();
	}
	
	public function updateDescription(){
	
		$study = $this->study;
		$study->description = request('description');
	
		if($study->description !== null){
			$study->save();
			request()->session('message','Your changes were saved!');
		} else {
			request()->session('error','Your changes couldn\'t be saved!');
		}
	
		return Redirect::back();
	}
	
	public function updateStudyIcon(){
		
		$file = request()->file('file');
	  	
	  	if ($file->isValid()){
	  		
	  		//Get the Context of the Image
	  		$study = Study::find($this->study->id);
	  		
	  		//Get Unique String
	  		$uuid = str_replace([' ','.'],'',microtime());
	  		
	  		//Place Image
	  		$destinationPath = public_path().'/images/uploads'; // upload path
		    $extension = request()->file('file')->getClientOriginalExtension(); // getting image extension
		    $fileName = $uuid.'.'.$extension; // renameing image
		    $file->move($destinationPath, $fileName); // uploading file to given path
		    
		    //Enter Image into Database
		    $dbImage = new Image;
		    $dbImage->name = $uuid.'.'.$extension;
		    $dbImage->src = url('/images/uploads/'.$fileName);
		    $dbImage->alt_text = $study->present()->title;
	 		$dbImage->bible_verse_id = $this->study->mainVerse->id;
	 		$dbImage->user_id = Auth::user()->id;
		    $dbImage->save();
		    
		    //Set Image as Default Image for Study
		    $study->image_id = $dbImage->id;
		    $study->save();
		    
		    //Notify User of Success
		    request()->session('message','Uploaded successfully');
			
		    return Redirect::back();
	  	}
		
	  	request()->session('error','File couldn\'t be uploaded');
	  	
	  	return Redirect::back();
	  	
	}
	
	protected function paginateResults(array $results, $perPage = 0)
	{
		
		$page = request('page');
		
		$index = $page-1;
		if($page <= 0){
			$index = 0;
		}
		
		if(empty($results)){
			$pagedResults[0] = null;
		}else{
			$pagedResults = array_chunk($results, $perPage);
		}
	
		return new LengthAwarePaginator($pagedResults[$index], count($results), $perPage, $page,
		[
            'path'  => \Request::url()
        ]);
		
	}
	
	public function detachRecording(){
		
		//!!
		//Create Validation for request
		//!!
		
		$study = Study::find(request('study_id'));
		$study->recordings()->detach(request('recording_id'));
		
		request()->session('message','Successfuly removed recording with #'.request('recording_id'));
		
		return Redirect::back();
	}

	public function publish($study)
	{

		$study->publish();
		$study->save();
	
		return Redirect::back();
	}
	
	public function storeTask($study){
	
		$type = request('task_type');
	
		$orderBy = $study->tasks->count() + 1;
	
		$count = $study->tasks()->where('task_type_id',$type)->count() + 1;
		
		$task = $study->tasks()->create([
				'task_type_id'=> $type,
				'orderBy'=> $orderBy,
				'title'=> '#' . $count
		]);
	
		request()->session('message','Task Created.');

		return Redirect::to('/user/study-maker/256/task/'.$task->id.'/edit');
	}
	
	public function editTask($study, $task){
	
		$task = $task->buildEditor();
		
		$page = new stdClass();
		$page->title = 'Builder';

		return view($task->templates->edit, compact('study','task','page'));
	
	}
	
	public function updateTask($study, $task)
	{
	
		$task->update([
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
	
	
	/*
	 * 
	 * public function previousAndNext($lessons, $current_lesson_key, $countOfLessons, $user = null){
		
		$previous = $current_lesson_key-1;
		$next = $current_lesson_key+1;
		
		$previousLesson = null;
		$nextLesson = null;
		$currentLesson = $next;
		
		$leftMarker = '<span class="glyphicon glyphicon-chevron-left"></span>';
		$rightMarker = '<span class="glyphicon glyphicon-chevron-right"></span>';
		
		if(isset($lessons[$previous])){
			$previousLesson = $lessons[$previous];
		}
		if(isset($lessons[$next])){
			$nextLesson =  $lessons[$next];
		}
		
		if($previousLesson == null){
			$leftMarker = null;
		}
		if($nextLesson == null){
			$rightMarker = null;
		}

		if($user !== null)
		{
		return '<a href="/@'.$user->username.'/courses'.$previousLesson.'">'.$leftMarker.' </a> Lesson '.$currentLesson.' <a href="/@'.$user->username.'/courses'.$nextLesson.'"> '.$rightMarker.'</a>';
		}else{
			return '<a href="'.$previousLesson.'">'.$leftMarker.' </a> Lesson '.$currentLesson.' <a href="'.$nextLesson.'"> '.$rightMarker.'</a>';
		}
	}
	
	 * 
	 * */
	
}
