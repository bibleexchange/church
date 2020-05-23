<?php namespace App;

class Track extends BaseModel {
  
  public $timestamps = true;
  protected $table = 'tracks';
  protected $fillable = ['course_id', 'user_id', 'lesson_id'];
  protected $appends = array('activity');

  public function user(){
    return $this->belongsTo('\App\User');
  }
  
  public function course() {
    return $this->belongsTo('\App\Course');
  }
  
  public function lesson() {
    return $this->belongsTo('\App\Lesson');
  }
  
  public function getActivityAttribute() {

    $activities = $this->course->activities()->orderBy('lessons.order_by','ASC')->orderBy('activities.order_by','ASC')->get();

    if($activities->count() < 1){
      $this->course->buildActivities();
      
    $activities = $this->course->activities()->orderBy('lessons.order_by','ASC')->orderBy('activities.order_by','ASC')->get();
    }

    foreach($activities AS $a){
      if($this->user->hasNotCompletedActivity($a)){
        return $a;
      }
    }

  }

  public function statements() {
    return $this->hasMany('\App\Statement');
  }

}