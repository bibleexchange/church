<?php namespace App\Bible\Entities;

use Str;

class BibleChapter extends \Eloquent {
	
	//protected $connection = 'scripture';
	protected $table = 'biblechapters';
	protected $fillable = array('key_english_id','orderBy','summary');
	protected $appends = array('nextURL','previousURL','url','reference','nextReference');
	
	public function book()
	{
	    return $this->belongsTo('\App\Bible\Entities\BibleBook', 'key_english_id');
	}
	
	public function verseByOrderBy($orderBy)
	{		
		return $this->hasMany('\App\Bible\Entities\BibleVerse')->where('v','=',$orderBy)->first();
	}	
	
	public function verses()
	{
	    return $this->hasMany('\App\Bible\Entities\BibleVerse');
	}
	
	public function notes()
	{
		return $this->hasManyThrough('\App\Bible\Entities\Note','\App\Bible\Entities\BibleVerse');
	}
	
	public function studies()
	{
		return $this->hasManyThrough('\App\Bible\Entities\Study','\App\Bible\Entities\BibleVerse','bible_chapter_id','main_verse')->public()->orderBy('published_at','ASC');
	}
	
	public function userNotes($user)
	{
		if($user === null){
			return [null];
		}
		
				$chapter_notes[] = array_where($verse->notes, function($key, $value)
				{
					$note;
				});		
		
		$chapter_notes = [null];

		$verses = $this->verses;	
		$authorsList = $user->followedUsers->lists('id');
		$authors = array_add($authorsList, null, $user->id);
		

		return $chapter_notes;
		
	}
	
	public function url()
	{
	    return '/kjv/' . $this->book->slug . '/' . $this->orderBy;
	}
	
	public function studyUrl($study)
	{
	    return '/study/' . $study->id . '-' . Str::slug($study->title) . '?bible=' .  $this->reference;
	}
	
	public function getReferenceAttribute()
	{
	    return $this->book->n . ' ' . $this->orderBy .':1';
	}
	
	public function getPreviousURLAttribute()
    {	
		$chapter = $this->find($this->id-1);

	   return '/kjv/'.str_replace(' ','',strtolower($chapter->book->n)).'/'.$chapter->orderBy;
    }
	
	public function getnextURLAttribute()
    {
       if ($this->id == 1189){$this->id == 0;}
	   $chapter = $this->find($this->id+1);
	   return '/kjv/'.str_replace(' ','',strtolower($chapter->book->n)).'/'.$chapter->orderBy;
    }
	
	public function getnextReferenceAttribute()
    {
       if ($this->id == 1189){
			$chapter = $this->find(1);
		}else{
			$chapter = $this->find($this->id+1);
		}
	  
	  return $chapter->reference;
    }
	
	public function getpreviousReferenceAttribute()
    {	
		
		if ($this->id == 1){
			$chapter = $this->find(1189);
		}else{
			$chapter = $this->find($this->id-1);
		}
		
	   return $chapter->reference;
    }
	
}