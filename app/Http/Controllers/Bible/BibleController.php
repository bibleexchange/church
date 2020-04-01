<?php namespace App\Http\Controllers\Bible;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect,Auth,Input, Flash, Session, stdclass;

use App\Bible\Entities\NoteRepository;
use App\Bible\Entities\BibleBook;
use App\Bible\Entities\BibleChapter;
use App\Bible\Entities\BibleVerse;
use App\Bible\Entities\BibleHighlight;

class BibleController extends Controller {
	
	function __construct(NoteRepository $noteRepository){
		$this->noteRepository = $noteRepository;
	}
	
	public function index()
	{	
		if(Session::has('last_scripture')){

			return Redirect::to(url("bible" . Session::get('last_scripture')));
			
		}else{
		
		$book = BibleBook::find(40);
		$chapter = 1;
		
		return Redirect::to('/kjv/'.$book->slug.'/'.$chapter);
		}
		
	}

	public function getBook($book)
	{
		$booksOftheBible = BibleBook::all();

        if(is_string($book)){
            $book = $booksOftheBible->first();
        }
		return view('bible.book', compact('book','booksOftheBible'));
	}
	
	public function getVerse($book,$chapter,$verseByv)
	{					
		$booksOftheBible = BibleBook::all();
		$verse = $book->chapters[$chapter-1]->verses[$verseByv-1];
		$this->noteRepository = new NoteRepository;
		if(Auth::user()){
			$notes = $this->noteRepository->getFeedForUserWhereVerse(Auth::user(),$verse);
		}else{
			$notes = $this->noteRepository->getFeedForPublicNotesWhereVerse($verse);
		}
		
		$versePage = true;
		$notes_per_page = 5;
		$data_path = '/api/v1/notes/bible/verse/'.$verse->id."?count=".$notes_per_page;
		
		return view('bible.verse', compact('verse','booksOftheBible','notes','versePage','notes_per_page','data_path'));
	}
	
	public function postVerse()
	{
		$verse_id = (Input::get('verse'));
		$verse = BibleVerse::find($verse_id);
		return Redirect::to($verse->chapterURL);
	}
	
	public function getChapterVerses($book,$chapterOrderBy,$verse = null)
	{
        $booksOftheBible = BibleBook::all();

        if(is_string($book)){
            $book = $booksOftheBible->first();
        }

		$chapter = $book->chaptersByOrderBy($chapterOrderBy);

		if (isset($_GET['verse'])){$urlVerse = $_GET['verse'];}else {$urlVerse = $verse;}
		
		if(Auth::check()){
			$notes = $this->noteRepository->getFeedForUserWhereVerses(Auth::user(),$chapter->verses->only('id')->toArray() );
		}else{
			$notes = $this->noteRepository->getFeedForPublicNotesWhereVerses($chapter->verses->only('id')->toArray());
		}
		
		$currentReference = $book->n.' '.$chapter->orderBy;
		
		if ($urlVerse !== null){
			
			$currentReference = $currentReference.':'.$urlVerse;
		}
		
		$notes_per_page = 3;
		$data_path = '/api/v1/notes/bible/'.$chapter->book->slug.'/'.$chapterOrderBy."?count=".$notes_per_page;
		
		\Session::put('last_scripture', $chapter->url());
		\Session::put('last_scripture_readable', $currentReference);
		
		$highlight_colors = BibleHighlight::getColors();
		$meta = $this->meta();
		return view('bible.chapter', compact('book','chapter','urlVerse','booksOftheBible','notes','currentReference','notes_per_page','data_path','highlight_colors','meta'));
	}
	
	public function getSearch()
	{			

		$booksOftheBible = BibleBook::all();
		$search = Input::get('q');
		$verses = BibleVerse::searchForVerses($search);

		if (empty($verses)){
		
			Flash::message('I couldn\'t find that verse. Maybe these results will help.');
		
			return Redirect::to('/search/'.$search);
		}
		
		if (count($verses) === 1){
			return Redirect::to($verses[0]->url());
		}
		
		return view('bible.search', compact('verses','search','booksOftheBible'));
	}

    public function meta(){
	
		$meta = new stdClass();

		$meta->keywords = 'faith, hope, bible, study, learn';
		$meta->author = 'Deliverance Center';
		$meta->title = 'Bible Exchange';
		$meta->description = 'Bible exchange is your companion in discovery. Equip yourself to better know and share your faith in Jesus Christ by engaging in Biblical conversation.';//No more than 155 characters
		$meta->shareImage = url('/images/be_logo.png');//Twitter summary card with large image must be at least 280x150px
        $meta->mainImage = url('/images/be_logo.png');
		$meta->siteName = 'Bible exchange';
		$meta->publisherTwitterHandle = '@bible_exchange';
		$meta->authorTwitterHandle = '@mjamesderocher';
		$meta->ogurl = 'http://bible.exchange/index'; //current url

		$meta->articlePublished = '2015-02-25T19:08:47+01:00';//2013-09-16T19:08:47+01:00
		$meta->articleModified = '2015-02-25T19:08:47+01:00';//2013-09-16T19:08:47+01:00
        $meta->created_at = '2015-02-25T19:08:47+01:00';//2013-09-16T19:08:47+01:00
		$meta->updated_at = '2015-02-25T19:08:47+01:00';//2013-09-16T19:08:47+01:00


		$meta->facebookAppId = '1529479753993292';
		$meta->articleSection = 'Index of Bible exchange';
		$meta->articleTag = $meta->keywords;
		$meta->twitter = '@bible_exchange';
        $meta->creator = 'Deliverance Center';
		return $meta;
	}

}
