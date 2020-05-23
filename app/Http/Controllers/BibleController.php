<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect, Session;
use App\BibleVerse, App\BibleChapter;

class BibleController extends Controller
{
    public function index()
	{	
		if(Session::has('last_scripture')){
			return Redirect::to(url(Session::get('last_scripture')));
		}else{

		$verse = BibleVerse::find(40);
		return Redirect::to($verse->chapterUrl());
		}		

		
	}

	public function getBook($verses)
	{
		return view('bible.verses', compact('verses'));
	}
	
	public function getVerse($book,$chapter,$verseByv)
	{					
		$booksOftheBible = BibleBook::all();
		$verse = $book->chapters[$chapter-1]->verses[$verseByv-1];
		$nr = new \App\Helpers\NoteRepository;
		if(Auth::user()){
			$notes = $nr->getFeedForUserWhereVerse(Auth::user(),$verse);
		}else{
			$notes = $nr->getFeedForPublicNotesWhereVerse($verse);
		}
		
		$versePage = true;
		$notes_per_page = 5;
		$data_path = '/api/v1/notes/bible/verse/'.$verse->id."?count=".$notes_per_page;
		
		return view('bible.verse', compact('verse','booksOftheBible','notes','versePage','notes_per_page','data_path'));
	}
	
	public function postVerse(Request $request)
	{
		$verse_id = $request->input('verse');
		$verse = BibleVerse::find($verse_id);
		return Redirect::to($verse->chapterURL);
	}
	
	public function getChapterVerses(Request $request, $book,$chapterOrderBy,$verse = null)
	{
        $booksOftheBible = BibleBook::all();

        if(is_string($book)){
            $book = $booksOftheBible->first();
        }

		$chapter = $book->chaptersByOrderBy($chapterOrderBy);

		if (isset($_GET['verse'])){$urlVerse = $_GET['verse'];}else {$urlVerse = $verse;}
		
		if(Auth::check()){
			$notes = $nr->getFeedForUserWhereVerses(Auth::user(),$chapter->verses->only('id')->toArray() );
		}else{
			$notes = $nr->getFeedForPublicNotesWhereVerses($chapter->verses->only('id')->toArray());
		}
		
		$currentReference = $book->n.' '.$chapter->orderBy;
		
		if ($urlVerse !== null){
			
			$currentReference = $currentReference.':'.$urlVerse;
		}
		
		$notes_per_page = 3;
		$data_path = '/api/v1/notes/bible/'.$chapter->book->slug.'/'.$chapterOrderBy."?count=".$notes_per_page;
		
		Sesson::put('last_scripture', $chapter->url());
		Sesson::put('last_scripture_readable', $currentReference);
		
		$highlight_colors = BibleHighlight::getColors();
		$meta = $this->meta();
		return view('bible.chapter', compact('book','chapter','urlVerse','booksOftheBible','notes','currentReference','notes_per_page','data_path','highlight_colors','meta'));
	}
	
	public function getSearch(Request $request)
	{			

		$booksOftheBible = BibleBook::all();
		$search = $request->input("search");
		$verses = BibleVerse::searchForVerses($search);
        
		if (empty($verses)){
		
			request()->flash('message','I couldn\'t find that verse. Maybe these results will help.');
		
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
