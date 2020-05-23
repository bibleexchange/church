<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ManageTableTrait;

class Tag extends Model implements \App\Interfaces\ModelInterface
{
  
    use ManageTableTrait;

    public $fillable = ['value','object_id','object_class'];

    public function modifySchema($table){

      $table->id();
      $table->string('value');
      $table->unsignedBigInteger('object_id');
      $table->string('object_class');

      return $table;
  }

  public function getSeed(){
    return \Config::get('seeds')['tags'];
  }
}
