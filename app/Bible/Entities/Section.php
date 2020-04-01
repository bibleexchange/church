<?php namespace App\Bible\Entities;
 
class Section extends \Eloquent {
	
	protected $fillable = array('title','description','courses_id','orderBy','created_at','updated_at');

	public function course()
	{
	    return $this->belongsTo('\App\Bible\Entities\Course', 'course_id');
	}
    
	public function studies()
	{
		return $this->belongsToMany('\App\Bible\Entities\Study')->orderBy('orderBy','ASC')->orderBy('created_at','ASC');
	}
}