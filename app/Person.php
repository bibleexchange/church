<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

   protected $fillable = [];
   protected $dates = ['created_at','updated_at'];

 public function modifySchema($table){
      $table->id();
      $table->date('dated');
      $table->string('title');
      $table->string('description');
      $table->string('genre');

      $table->timestamps();

      return $table;
  }

  public function seed(){
  	ImportSql::import([\Config::get('seeds')['RECORDINGS']]);
  }

}