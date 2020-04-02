<?php namespace App\Transformers;

use Auth;

class BibleTransformer extends Transformer{

	public function transform($verse)
	{
		$user_notes = null;
		
		if(Auth::check()){
			$user_notes = Auth::user()->notes()->where('bible_verse_id', $verse->id)->orderBy('created_at','DESC')->take(3)->get();
		}
		
		return [
			'link'=> $verse->resourceURL(),
			'body'=> $verse->t,
			'user_notes'=> $user_notes
		];
		
	}
	
}