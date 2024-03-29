<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class BibleTranslation extends Model {
	
	protected $table = 'bible_translations';
	public $timestamps = false;
	protected $fillable = array('translation','verse_id','text');
	
	public function verse()
	{
	    return $this->belongsTo('\App\BibleVerse', 'verse_id');
	}
	
	public function version(){
		 return $this->belongsTo('\App\BibleVersion', 'version_id');
	}
	
	public static function scopeKJVR($query)
	{
		return $query->where('version_id','1');
	}
	
}
