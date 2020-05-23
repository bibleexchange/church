<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LibraryBookChapterSection extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['body', 'footnote','library_book_chapter_id', 'user_id','order_by'];

    public function modifySchema($table){

      $table->id();
      $table->string('body');
      $table->string('footnote')->nullable();
	    $table->integer('order_by')->unsigned()->nullable();
	    $table->foreignId('library_book_chapter_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

      $table->timeStamps();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['library_chapter_sections'];

  }
}