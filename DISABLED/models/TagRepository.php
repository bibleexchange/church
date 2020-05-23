<?php namespace App;

use App\Tag;		

class TagRepository {
	
	public function __construct()
	{

	}
	
    public function save(Tag $tag)
    {
    	return $tag->save();
    }

} 