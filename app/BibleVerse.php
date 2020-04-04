<?php namespace App;

class BibleVerse extends \Eloquent {
	
	//protected $connection = 'scripture';
	protected $table = 't_kjv';
	public $timestamps = false;
	protected $fillable = array('b','c','v','t','biblechapter_id');
	protected $appends = array('chapterURL','reference','url','quote');
	
	public static function scopeSearch($query,$search)
	{
		return $query->where('t_kjv.t','LIKE','%'.$search.'%');
	
	}
	
	public static function isValidReference($reference){
		
		//places a . between book name and reference.
		//i.e. changes "Song of Solomon 9:6" to "Song of Solomon.9:6"
		$string = preg_replace('/\s(\S*)$/', '.$1', trim($reference)); //trim end for sanitization.
		$verse_number = 1;
		
		//split
		$separatedArray = explode(".",$string);
		$bible = new BibleBook;
		
		$book = $bible->findByName($separatedArray[0]);
		
		if(!is_object($book))
		{
			return false;
		}
		
		//split chapter and verse
		
		if(!isset($separatedArray[1]))
		{
			return false;
		}
		
		$separatedVerse = explode(":",$separatedArray[1]);

		$chapter = $book->chaptersByOrderBy($separatedVerse[0]);

		if($separatedVerse[0] > $book->chapters->count())
		{
			return false;
		}
		
		if(isset($separatedVerse[1])){
			
			$verse_number = $separatedVerse[1];
		}
		
		$verse = sprintf("%02s", $book->id).sprintf("%03s", $chapter->orderBy).sprintf("%03s", $verse_number);
		
		if (BibleVerse::find($verse) !== NULL){
			return BibleVerse::find($verse);
		}
		
		return false;
		
	}
	
	public function url($option = null)
	{		
		return '/bible/' . $this->book->slug . '/' . $this->c . '/' . $this->v;
	
	}
	
	public function resourceUrl ()
	{
		return url("/bible/".$this->book->slug . '_' . $this->c . '_' . $this->v);
	}
	
	public function book()
	{
	    return $this->belongsTo('\App\BibleBook', 'b');
	}
	
	public function notes()
	{
		return $this->hasMany('\App\Note','bible_verse_id');
	}
	
	public function crossReferences()
	{
		return $this->hasMany('\App\CrossReference','vid');
	}
	
	public function studies()
	{
		return $this->hasMany('\App\Study','main_verse');
	}
	
	public function translations()
	{
		return $this->hasMany('\App\BibleTranslation','verse_id');
	}
	
	public function kjvrText(){
	
		if($this->translations()->kJVR()->first() != NULL){
		
			return $this->translations()->kJVR()->first()->text;

		} else {
			return $this->t;
		}
	
	}
	
	public function chapter()
	{
	    return $this->belongsTo('\App\BibleChapter', 'bible_chapter_id');
	}
	
	public function getChapterURLAttribute()
    {	
	   return '/bible/'.$this->book->slug.'/'.$this->c.'/'.$this->v;
    }
	
	public function getReferenceAttribute()
    {	       	
    	return $this->book->n . ' ' . $this->c . ':' . $this->v;
    }
	
    public function getQuoteAttribute()
    {
    	return '<blockquote><a href="'.$this->chapterURL.'">' . $this->book->n . ' ' . $this->c . ':' . $this->v . '</a>&mdash;' . $this->t.'</blockquote>';
    }
    
    public function mdQuote()
    {
    	return '> ['.$this->book->n . ' ' . $this->c . ':' . $this->v.']('.$this->chapterURL.')&mdash;' . $this->t;
    }
    
    public function focus($string = null)
    {
    	if($string === NULL){
    		return $this->t;
    	}else{
    		//$verseStripped = preg_replace('/[^a-z]+/i', ' ', $verse);//keep only letters and numbers
    		$verse = $this->t;
    		$array = explode(strtolower($string),strtolower($verse),2);
    		$string = '<strong>'.strtoupper($string).'</strong>';
    		$startD = '';
    		$endD = '';
    			
    		if (count($array) >=2){
    			if (strlen($array[0]) >=15){$startD = '...';}
    			if (strlen($array[1]) >=20){$endD = '...';}
    			return $startD.substr($array[0],-15,15).$string.substr($array[1],0,20).$endD;
    			
    		}else{
    			var_dump($array);
    			return '...'.substr($array[0],-15,15).$string;
    		}
    	}
    	
    }
    
    public function searches(){
    	return $this->belongsToMany('\App\Bible\Services\Search')->withPivot('bible_verse_id', 'search_id');
    }
    
    public static function convertReferenceToQuote($reference){

    	$verse = self::isValidReference($reference);

    	if($verse)
    	{
    		return $verse->mdQuote();
    	}
    	
    	return '{% INVALID-->'.$reference.'<--INVALID %}';
    }
    
	public static function referenceTranslator($string){
		
		$string = str_replace(';',':',$string);
		$string = preg_replace('/\s(\S*)$/', '.$1', trim($string)); //trim end for sanitization.
		
		//split
		$separatedArray = explode(".",$string);
		$bible = new BibleBook;
		
		$book = $bible->findByName($separatedArray[0]);
		
		if(!is_object($book))
		{
			return null;
		}
		
		//check if there is a chapter
		if(!isset($separatedArray[1]))
		{
			$arrayOfVerses[] = sprintf("%02s", $book->id).'001001';
			return $arrayOfVerses;
		}
		
		//split chapter and verse
		$separatedVerse = explode(":",$separatedArray[1]);
		
		if(!isset($separatedVerse[1]))
		{
			$arrayOfVerses[] = sprintf("%02s", $book->id).sprintf("%03s", $separatedVerse[0]).'001';
			return $arrayOfVerses;
		}
			$chapter = $book->chaptersByOrderBy($separatedVerse[0]);
		
			if($chapter === null)
			{
				return null;
			}
			
			$anotherSplit = explode("-",$separatedVerse[1]);
			$start_verse = $anotherSplit[0];	
			$start_verse_id = sprintf("%02s", $book->id).sprintf("%03s", $chapter->orderBy).sprintf("%03s", $start_verse);
			$verseObject = BibleVerse::find($start_verse_id);
			
			if($verseObject === null)
			{
				return null;
			}
			
			if (isset($anotherSplit[1])) {
				
				$end_verse = $anotherSplit[1];
				
				if($end_verse > $verseObject->chapter->verses->count())
				{
					$end_verse = $verseObject->chapter->verses->count();
				}
				
				for($i=$start_verse; $i<= $end_verse; $i++){
						
					$arrayOfVerses[] = sprintf("%02s", $book->id).sprintf("%03s", $chapter->orderBy).sprintf("%03s", $i);
						
				}
				
				
			}else {
				
				$arrayOfVerses[] = $start_verse_id;
			}
			
			return $arrayOfVerses;
		}
		
	public static function searchForVerses($search){
		
		$referencesSearched = explode(",",$search);
		
		foreach ($referencesSearched AS $v){
				
			$verseId = BibleVerse::referenceTranslator($v);
			
			if ($verseId === null) {
				$verses = [];
			}else{
			
				foreach($verseId AS $id){
						
					$verses[] = BibleVerse::find($id);
				}
			}
		}
		
		return $verses;
	}
	
	public function highlights()
	{
		return $this->hasMany('\App\BibleHighlight','bible_verse_id');
	}
	
	public function userHighlight($user)
	{
		return $this->hasMany('\App\BibleHighlight','bible_verse_id')->where('user_id', $user->id)->first();
	}
	
	
}
