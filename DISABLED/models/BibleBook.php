<?php namespace App;

use Auth;

class BibleBook extends \Eloquent {
	
	protected $table = 'key_english';

	public $fillable = array('n','t','g');
	public $timestamps = false;
	
	public static function scopeSearch($query,$search)
	{
		return $query
			->where('n','LIKE','%'.$search.'%')
			->orWhere('slug','LIKE','%'.$search.'%')
			->orWhere('t','LIKE','%'.$search.'%');
	
	}
	
	public function url()
	{
	    return '/bible/' . $this->slug;
	}
	
	 public function findByName($name){		
		$name = strtolower(substr($name,0,4));
		return $this->where('n','LIKE',"%$name%")->first();
	 }

 public function chapters()
    {
        return $this->hasMany('\App\BibleChapter', 'key_english_id');
    }
	
	public function chaptersByOrderBy($chapter)
    {
        return $this->hasMany('\App\BibleChapter', 'key_english_id')->where('orderBy','=',$chapter)->first();
    }
	
	public function verses()
    {
        return $this->hasMany('\App\BibleVerse', 'b');
    }
	
    public function isOT(){
    	return $this->where('t','OT');
    }
    
    public function isNT(){
    	return $this->where('t','NT');
    }    
    
    public static function testaments(){
		
    	$books = new \App\BibleBook;
    	
    	$books->both = $books->pluck('n');
    	
    	$books->ot = array_where($books->both, function($key, $value)
						{
						   if ($key <= 38){ return $value;}
						});

    	$books->nt = array_where($books->both, function($key, $value)
						{
						   if ($key >= 39){ return $value;}
						});
    	
    	return $books;
    }
}