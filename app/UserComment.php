<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserComment extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['body','user_id','object_id','object_class'];

    public function modifySchema($table){

      $table->id();
      $table->string('body')->default('AMEN');
      $table->integer('object_id')->unsigned();
      $table->string('object_class');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['comments'];

  }
}
