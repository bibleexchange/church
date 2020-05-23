<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['title','description','user_id'];

    public function modifySchema($table){

      $table->id();
      $table->string('title');
      $table->string('description');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['classrooms'];

  }
}
