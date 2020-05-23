<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Library extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['title', 'description', 'art', 'public', 'user_id','editors'];

    public function modifySchema($table){

      $table->id();
      $table->string('title');
      $table->string('description')->nullable();
      $table->string('art')->nullable();
      $table->boolean('public')->default(false);
      $table->string('editors')->nullable();

      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['libraries'];

  }
}
