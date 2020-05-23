<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomSeriesCourseLessonActivity extends Model implements \App\Interfaces\ModelInterface 
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['type','body','lesson_id','user_id','text_id','order_by'];

    public function text()
    {
      return $this->belongsTo('\App\ClassroomSeriesCourseLessonActivityText');
    }

    public function modifySchema($table){

      $table->id();
      $table->string('type')->default('READ');
      $table->binary('body');
      $table->unsignedBigInteger('text_id')->index()->nullable();
      $table->integer('order_by')->unsigned();

      $table->foreignId('lesson_id','cscl_id')->references('id')->on('classroom_series_course_lessons')->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

      $table->timeStamps();

      return $table;

  }

  public function getSeed(){
    return \Config::get('seeds')['activities'];
  }
}
