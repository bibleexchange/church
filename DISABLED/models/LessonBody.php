<?php namespace App;

use Str,stdClass;
use App\Lesson;

class LessonBody extends BaseModel {

	protected $table = 'bodies';
	protected $fillable = array('text','lesson_id','created_at','updated_at');
	protected $appends = array();

	public function lesson()
	{
	    return $this->belongsTo('App\Lesson');
	}

}
