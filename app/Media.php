<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['format','value','link','user_id'];

    public function modifySchema($table){

      $table->id();
      $table->string('format');
      $table->binary('value')->nullable();
      $table->string('link')->nullable();
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['media'];

  }
}
