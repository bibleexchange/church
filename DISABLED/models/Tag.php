<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

	protected $fillable = ['name'];
	
	public static function make($name)
	{
		$tag = new static(compact('name'));
	
		return $tag;
	}
	
	public function studies(){
		
		return $this->belongsToMany('\App\Tag');
		
	}
	
}
