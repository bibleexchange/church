<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomSeriesCourseLessonActivityText extends Model {

	use \App\Traits\ManageTableTrait;
	
	protected $fillable = ['text','flags','note','activity_id','user_id','deleted'];
	
	public $timestamps = false;
	
	public function activity()
	{
		return $this->belongsTo('\App\Activity');
	}
	
	public function modifySchema($table){

      $table->id();
      $table->string('text');
      $table->string('flags')->nullable();
	  $table->string('note');
	  $table->boolean('deleted')->default(false);
	  $table->unsignedBigInteger('activity_id');
	  $table->unsignedBigInteger('user_id');

	  $table->foreign('activity_id','cscla_id')->references('id')->on('classroom_series_course_lesson_activities')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('user_id','user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
	  $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['texts'];

  }
}
