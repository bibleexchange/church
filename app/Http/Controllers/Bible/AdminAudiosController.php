<?php namespace App\Http\Controllers\Bible;

use App\Bible\Entities\Audio;
use App\Bible\Requests\AdminUpdateAudioRequest;
use App\Bible\Requests\AdminCreateAudioRequest;
use Input, Redirect;

class AdminAudiosController extends Controller {
	 
	 public function __construct() {		
		
	 }
	 
	 public function index()
	 {
	 	$audios = Audio::all();
	 
	 	return view('admin.audios.index', compact('audios'));
	 }
	 
	 public function store(AdminCreateAudioRequest $request)
	 {
	 	$audio = new Audio;
	 	$audio->date = Input::get('date');
		$audio->title = Input::get('title');
		$audio->bible_verse_id = \App\Bible\Entities\BibleVerse::referenceTranslator(Input::get('bible'))[0];
		$audio->theme = Input::get('theme');
		$audio->download = Input::get('download_url');
		$audio->host = Input::get('host');
		$audio->genre = Input::get('genre');
		$audio->memo = Input::get('memo');
		$audio->save();
		
		\Flash::message('Audio created successfully.');
		
		return Redirect::back();
	 	
	 }
	 
	 public function update(AdminUpdateAudioRequest $request)
	 {
	 	 
	 	dd(Input::all());
	 	 
	 }
	 
}
