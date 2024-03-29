<?php namespace App;

use Str,stdClass;

class BibleList extends BaseModel {

	//protected $connection = 'scripture';
	protected $table = 'biblelists';
	protected $fillable = array('name','description');
	protected $appends = array();

	public function verses()
	{
	    return $this->belongsToMany('App\BibleVerse','bibleverse_biblelist','biblelist_id','bibleverse_id');
	}

}
