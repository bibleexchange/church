<?php namespace App\Http\Controllers\Api;
use App\Lesson;
use App\Tag;
use App\Transformers\TagTransformer;
use App\Commands\CreateTagCommand;
use Input, Auth, Str;

class ApiTagsController extends ApiController {
	/**
	 * 
	 *
	 * @var /Entities/Transformers/LessonTransformer
	 */
	protected $tagTransformer;
	
	function __construct(TagTransformer $tagTransformer){
		
		$this->tagTransformer = $tagTransformer;
		
		$this->middleware('auth.basic',['only'=>['store']]);
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($lessonId = null)
	{
		
		$tags = $this->getTags($lessonId);
		
		return $this->respond([
			'data'=>$this->tagTransformer->transformCollection($tags->all())
		]);
	}
	
	public function getTags($lessonId){
		
		$tags = $lessonId ? Lesson::findOrFail($lessonId)->tags : Tag::all();
		
		return $tags;
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(/*CreateLessonApiRequest $request*/)
	{
		if ( ! request('title') or ! request('content'))
		{			
			//422 unprocessable entity
			return $this->setStatusCode(422)
				->respondWithError('Parameters failed validation for a tag');
		}
		
		$tag = $this->dispatch(new CreateTagCommand(
					request('title'), 
					Auth::user()->id, 
					Str::slug(request('title')),
					request('content')
				));
		
		return $this->setStatusCode(201)->respond([
				'status'=>'success',
				'message'=>'Tag successfully created.'
		]);
		
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$tag = Tag::find($id);
		
		if(! $tag){
			
			return $this->respondNotFound('Tag does not exist.');
			
		}
		
		return $this->respond([
				'data'=>$this->tagTransformer->transform($tag)
		]);
		
	}
	
}
