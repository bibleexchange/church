<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ministry extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['title','user_id','config','show_home_page'];

    public function modifySchema($table){

      $table->id();
      $table->string('title');
      $table->binary('config')->nullable();
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->boolean('show_home_page')->default(false);
      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['ministries'];

  }
}
