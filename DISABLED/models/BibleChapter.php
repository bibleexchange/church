<?php namespace App;

use Str;

class BibleChapter extends \Eloquent {
	
	//protected $connection = 'scripture';
	protected $table = 'biblechapters';
	protected $fillable = array('key_english_id','orderBy','summary');
	protected $appends = array('nextURL','previousURL','url','reference','nextReference');
	
	public function book()
	{
	    return $this->belongsTo('\App\BibleBook', 'key_english_id');
	}
	
	public function verseByOrderBy($orderBy)
	{		
		return $this->hasMany('\App\BibleVerse')->where('v','=',$orderBy)->first();
	}	
	
	public function verses()
	{
	    return $this->hasMany('\App\BibleVerse');
	}
	
	public function notes()
	{
		return $this->hasManyThrough('\App\Note','\App\BibleVerse');
	}
	
	public function studies()
	{
		return $this->hasManyThrough('\App\Study','\App\BibleVerse','bible_chapter_id','main_verse')->public()->orderBy('published_at','ASC');
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
		$authorsList = $user->followedUsers->pluck('id');
		$authors = array_add($authorsList, null, $user->id);
		

		return $chapter_notes;
		
	}
	
	public function url()
	{
	    return '/bible/' . $this->book->slug . '/' . $this->orderBy;
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
        
		$chapter = $this->getPreviousChapter();

	   return '/bible/'.str_replace(' ','',strtolower($chapter->book->n)).'/'.$chapter->orderBy;
    }
	
	public function getnextURLAttribute()
    {
       $chapter = $this->getNextChapter();
	   return '/bible/'.str_replace(' ','',strtolower($chapter->book->n)).'/'.$chapter->orderBy;
    }
	
	public function getnextReferenceAttribute()
    {
	  return $this->getNextChapter()->reference;
    }
	
	public function getpreviousReferenceAttribute()
    {	
		return $this->getpreviousChapter()->reference;
    }

   public function getPreviousChapter()
    {	
		
		if ($this->id == 1){
			$chapter = $this->find(1189);
		}else{
			$chapter = $this->find($this->id-1);
		}
		
	   return $chapter;
    }

       public function getNextChapter()
    {	
		
       if ($this->id == 1189){
			$chapter = $this->find(1);
		}else{
			$chapter = $this->find($this->id+1);
		}

	   return $chapter;
    }

}
