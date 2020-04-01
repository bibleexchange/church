<?php namespace App\Bible\Entities;

use Illuminate\Support\Facades\URL;
use App\Bible\Core\PresentableTrait;
use App\Bible\Core\ShortableTrait;
use App\Bible\Presenters\Contracts\PresentableInterface;
use App\Bible\Relay\Support\Traits\GlobalIdTrait;
use App\Bible\Build\Course AS BuildCourse;
use Str, Cache, stdclass;

class Textbook extends BaseModel implements PresentableInterface {

	public $fillable = array('course_id','html','lang','created_at','updated_at');

	protected $appends = [];

	//protected $presenter = 'BibleExperience\Presenters\Course';

	use PresentableTrait, ShortableTrait, GlobalIdTrait;

 public function course()
  {
  	return $this->belongsTo('BibleExperience\course','course_id');
  }


			

}
