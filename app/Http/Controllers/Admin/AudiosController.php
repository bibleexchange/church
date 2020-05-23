<?php namespace App\Http\Controllers\Admin;

use App\Audio;
use App\Requests\AdminUpdateAudioRequest;
use App\Requests\AdminCreateAudioRequest;
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
	 	$audio->date = request('date');
		$audio->title = request('title');
		$audio->bible_verse_id = \App\BibleVerse::referenceTranslator(request('bible'))[0];
		$audio->theme = request('theme');
		$audio->download = request('download_url');
		$audio->host = request('host');
		$audio->genre = request('genre');
		$audio->memo = request('memo');
		$audio->save();
		
		request()->flash('message','Audio created successfully.');
		
		return Redirect::back();
	 	
	 }
	 
	 public function update(AdminUpdateAudioRequest $request)
	 {
	 	 
	 	dd(Input::all());
	 	 
	 }
	 
}
