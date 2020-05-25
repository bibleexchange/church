<?php

namespace App;

use Config, Illuminate\Database\Eloquent\Model;
use App\Helpers\BibleReference;

class BibleVerse extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

    public $fillable = ['code','book_name','book_order','chapter_order'];
    protected $appends = ['reference','kjv'];

    public $timestamps = false;

    public function modifySchema($table){

      $table->smallIncrements('id');
      $table->integer('code');
      $table->string('book_name', 25);
      $table->smallInteger('book_order');
      $table->smallInteger('chapter_order');
      return $table;

  }

  public function getReferenceAttribute(){
    $code = str_pad($this->code, 8, '0', STR_PAD_LEFT);
    $verse = $code[5] . $code[6] . $code[7];
    $verse = (int) $verse;
    $chapter = $code[2] . $code[3] . $code[4];
    $chapter = (int) $chapter;


    return $this->book_name . ' ' . $chapter . ":" . $verse; 
  }

  public function getKjvAttribute(){
    return \DB::table('t_kjv')->where('id',$this->code)->first();
  }

  public function afterSchema(){
    \DB::statement('ALTER TABLE bible_verses CHANGE code code INT(8) UNSIGNED ZEROFILL NOT NULL');
  }

  public function chapterUrl(){
    return url('/bible/'.$this->safeBookName().'_'.$this->chapter);
  }

  public function url(){
    return url('/bible/'.$this->safeBookName().'_'.$this->chapter.':'. $this->number);
  }

  public function book(){
     return \App\BibleVerse::where('code','like',substr($this->code, 0, 4).'%')->get();
  }

  public function safeBookName(){
    return str_replace(" ", "-", strtolower($this->book_name));
  }

  public function getChapterAttribute(){
    $code = (String) $this->code;

    if(strlen($code) === 7){
      $code = 0 . $this->code;
    }
    $code = $code[2] . $code[3] . $code[4];
    return (int) $code;
  }

  public function getNumberAttribute(){
    $code = (String) $this->code;

    if(strlen($code) === 7){
      $code = 0 . $this->code;
    }
    $code = $code[5] . $code[6] . $code[7];
    return (int) $code;
  }

  public function seed(){

   $bible_info = json_decode(file_get_contents(
      Config::get('seeds')['bible_verses']
    ));

   $book_id = 0;
   $chapter_count = 0;
   $verse_count = 0;

   foreach($bible_info AS $book){
   		$book_id++;
   		$chapter_id = 0;

   		foreach($book->chapters AS $chapter){
   			$chapter_id++;
   			$chapter_count++;
   			$verse_id = 0;
   			$versesCount = (int) $chapter->verses;

   			while($verse_id < $versesCount){
   				$verse_id++;
   				$verse_count++;

   				$id = str_pad($book_id, 2, '0', STR_PAD_LEFT) . 
   						str_pad($chapter_id, 3, '0', STR_PAD_LEFT) .
   						str_pad($verse_id, 3, '0', STR_PAD_LEFT);

   				static::create([
            "id"=> $verse_count,
   					"code"=> $id,
   					"book_name"=> $book->book,
   					"book_order"=> $book_id,
   					"chapter_order"=> $chapter_count
   				]);

   			}
   		}

   }

   unset($bible_info);

  }

  public static function findByReference($q){

      if($q === null || trim($q) === ""){
        return null;
      }

    $ranges = BibleReference::stringToReference($q);

    $verses = collect([]);
    foreach($ranges AS $range){
      $se = BibleReference::rangeToIds($range);
      $model = static::whereBetween('code', [$se->start, $se->end]);
      $verses = $verses->merge($model->get());
    }

    return $verses;
  }

 }