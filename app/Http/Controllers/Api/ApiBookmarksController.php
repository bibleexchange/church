<?php namespace App\Http\Controllers\Api;

use App\Bookmark;
use App\Transformers\BookmarkTransformer;
use App\Commands\CreateBookmarkCommand;
use Input, Auth, Str;

class ApiBookmarksController extends ApiController {
	/**
	 * 
	 *
	 * @var /Entities/Transformers/BookmarkTransformer
	 */
	protected $bookmarkTransformer;
	
	function __construct(BookmarkTransformer $bookmarkTransformer){
		
		$this->middleware('auth.basic');
		
		$this->bookmarkTransformer = $bookmarkTransformer;
		
		$this->currentUser = Auth::user();
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($bookmarkId = null)
	{
		
		$bookmarks = $this->getBookmarks($bookmarkId);
		
		return $this->respond([
			'data'=>$this->bookmarkTransformer->transformCollection($bookmarks->all())
		]);
	}
	
	public function getBookmarks($bookmarkId){
		
		$bookmarks = $bookmarkId ? Bookmark::findOrFail($bookmarkId)->bookmarks : Bookmark::all();
		
		return $bookmarks;
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(/*CreateBookmarkApiRequest $request*/)
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
		$bookmark = Bookmark::find($id)->where('user_id', $this->currentUser->id);
		
		if(! $bookmark){
			
			return $this->respondNotFound('Bookmark does not exist.');
			
		}
		
		return $this->respond([
				'data'=>$this->bookmarkTransformer->transform($bookmark)
		]);
		
	}
	
}
