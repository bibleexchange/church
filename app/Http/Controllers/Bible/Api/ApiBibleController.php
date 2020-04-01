<?php namespace App\Http\Controllers\Api;

use App\Bible\Entities\BibleBook;
use App\Bible\Entities\BibleChapter;
use App\Bible\Entities\BibleVerse;
use App\Bible\Entities\Tag;
use App\Bible\Entities\Transformers\BibleTransformer;
use App\Bible\Entities\BibleHighlight;

use Input, Auth, Str;

class ApiBibleController extends ApiController {
	/**
	 * 
	 *
	 * @var /Entities/Transformers/LessonTransformer
	 */
	protected $bibleTransformer;
	
	function __construct(BibleTransformer $bibleTransformer){
		
		$this->bibleTransformer = $bibleTransformer;
		
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
			'data'=>$this->bibleTransformer->transformCollection($tags->all())
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
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$verse = BibleVerse::find($id);
		
		if(! $verse){
			
			return $this->respondNotFound('Verse does not exist.');
			
		}
		
		return $this->respond([
				'data'=>$this->bibleTransformer->transform($verse)
		]);
		
	}
	
public function showChapter($chapter)
	{
		$booksOftheBible = BibleBook::all();
		$currentReference = $chapter->book->n.' '.$chapter->orderBy;
		
		\Session::put('last_scripture', $chapter->url());
		\Session::put('last_scripture_readable', $currentReference);
		
		$highlight_colors = BibleHighlight::getColors();
		
		return view('bible.chapter-min', compact('book','chapter','booksOftheBible','currentReference','highlight_colors'));
	}
}
