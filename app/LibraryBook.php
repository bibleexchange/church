<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryBook extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['title', 'description', 'art', 'public', 'library_id', 'user_id','authors','order_by'];

    public function modifySchema($table){

      $table->id();
      $table->string('title');
      $table->string('description')->nullable();
      $table->string('art')->nullable();
      $table->boolean('public')->default(false);
      $table->string('authors')->nullable();
      $table->integer('order_by')->unsigned()->nullable();

      $table->foreignId('library_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['library_books'];

  }

}