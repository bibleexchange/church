<?php namespace App\Bible\Entities;

use App\Bible\Entities\Tag;		

class TagRepository {
	
	public function __construct()
	{

	}
	
    public function save(Tag $tag)
    {
    	return $tag->save();
    }

} 