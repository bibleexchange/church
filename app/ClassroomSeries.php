<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassroomSeries extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['title','description','art','user_id','classroom_id','public'];

    public function modifySchema($table){

      $table->id();
      $table->string('title');
      $table->string('description')->nullable();
      $table->string('art')->nullable();
      $table->boolean('public')->default(false);
      $table->foreignId('classroom_id','c_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['series'];

  }

    public function scopePublic($query){
      return $query->where('public', 1);
  }
}
