<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class CrossReference extends Model {

	protected $table = 'cross_reference';
	protected $fillable = ['vid','r','sv','ev'];
	
	public function verse(){
	
		return $this->belongsTo('\App\BibleVerse','vid');
	}

}
