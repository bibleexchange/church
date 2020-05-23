<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryBookChapter extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['title', 'description', 'art', 'library_book_id', 'user_id','order_by'];

    public function modifySchema($table){

      $table->id();
      $table->string('title');
      $table->string('description')->nullable();
      $table->string('art')->nullable();
      $table->integer('order_by')->unsigned();
      $table->foreignId('library_book_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

      $table->timeStamps();

      return $table;

  }

  public function getSeed(){
    return \Config::get('seeds')['library_book_chapters'];
  }
}