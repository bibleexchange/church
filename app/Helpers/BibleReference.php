<?php namespace App\Helpers;

use App\BibleVerse;

class Range {
  public function __construct(){
      $this->cursor = 'start_book';

      $this->atts = [
        "start_book" => '',
        "end_book" => '',
        "start_chapter" => '',
        "end_chapter" => '',
        "start_verse" => '',
        "end_verse" => ''
    ];
  }

  public function done(){

    if($this->atts["end_book"] === ""){
      $this->atts["end_book"] = $this->atts["start_book"];
    }

    if($this->atts["start_chapter"] !== ""){
      $this->atts["start_chapter"] = (int) $this->atts["start_chapter"];
    }

    if($this->atts["end_chapter"] !== ""){
      $this->atts["end_chapter"] = $this->atts["start_chapter"];
      $this->atts["end_chapter"] = (int) $this->atts["end_chapter"];
    }

    if($this->atts["start_verse"] !== ""){
      $this->atts["start_verse"] = (int) $this->atts["start_verse"];
    }

    if($this->atts["end_verse"] !== ""){
      $this->atts["end_verse"] = (int) $this->atts["end_verse"];
    }

    return $this->atts;
  }
}

class BibleReference {

  public static function versesByBook($book_name){
     return \App\BibleVerse::where('book_name','like','%'.$book_name.'%')->get();
  }

  public static function stringToReference($value){
        $value = trim(str_replace("; ", ";", str_replace("_", " ", $value)));
        $len = strlen($value);
        $ctr = 0;

        $instructions = [];

      for($i = 0; $i < $len; $i++){

        if($i === 0){
          $instructions[$i] = ['start book', $value[$i]];
            $range = new Range();
            $range->atts[$range->cursor] .= $value[$i];
        }else{

           switch($value[$i]){

            case ':':

              if($range->cursor === 'end_chapter'){
                $instructions[$i] = ['end chapter', $value[$i]];
                $range->cursor = 'end_verse';
              }else{
                $instructions[$i] = ['end chapter', $value[$i]];
                $range->cursor = 'start_verse';
              }

              break;

            case ';':
              $instructions[$i] = ['end range', $value[$i]];
              $ranges[] = $range->done();
              $range = new Range();
              break;

            case '=':
              $instructions[$i] = ['end first range', $value[$i]];
              $range->cursor = 'end_book';
              break;

            case '-':

              if($range->cursor === 'start_chapter'){
                $instructions[$i] = ['end start chapter', $value[$i]];
                $range->cursor = 'end_chapter';
              }else{
                $instructions[$i] = ['end start verse', $value[$i]];
                $range->cursor = 'end_verse';
              }
              
              break;

            case ' ':
              //var_dump($value[$i], $value[$i-1], "<br/>");
              if($value[$i-1] !== ';' && $instructions[$i-2][0] !== 'end range' && $range->cursor !== 'end_book'){
                $instructions[$i] = ['end book', $value[$i]];
                $range->cursor = 'start_chapter';
              }else if($range->cursor === 'end_book' && $value[$i-1] !== ';' && $instructions[$i-2][0] !== 'end range'){
                $range->cursor = 'end_chapter';
              }else{
                $instructions[$i] = ['char', $value[$i]];
                $range->atts[$range->cursor] .= $value[$i];
              }            
              break;

            default:
              $instructions[$i] = ['char', $value[$i]];
               $range->atts[$range->cursor] .= $value[$i];

          }


        }
        
      }
        $ranges[] = $range->done();

        return $ranges;
  }

  public static function rangeToIds($range){
    /*
array:6 [▼
  "start_book" => "John"
  "end_book" => "John"
  "start_chapter" => 3
  "end_chapter" => ""
  "start_verse" => 1
  "end_verse" => ""
]
    */
      $start_book = \DB::table('key_english')->where('n', 'LIKE', '%'.substr($range['start_book'], 0, 5).'%')->first();

      if($start_book === null){
        return null;
      }else{
        $start_book = $start_book->b;
      }

      if($range['end_book'] !== ""){
        $end_book = \DB::table('key_english')->where('n', 'LIKE', '%'.substr($range['end_book'], 0, 5).'%')->first()->b;
      }else{
        $end_book = $start_book;
      }

      if($range['start_chapter'] === ""){
        $start_chapter = 1;
      }else{
        $start_chapter = $range['start_chapter'];
      }

      if($range['start_verse'] === ""){
        $start_verse= 1;
      }else{
        $start_verse = $range['start_verse'];
      }
  
      $startId = str_pad($start_book, 2, '0', STR_PAD_LEFT) . 
            str_pad($start_chapter, 3, '0', STR_PAD_LEFT) .
            str_pad($start_verse, 3, '0', STR_PAD_LEFT);

      if($range['end_chapter'] === "" && $range['start_chapter'] === ""){
        $end_chapter = 999;
      }else if($range['end_chapter'] === "" && $range['start_chapter'] !== ""){
        $end_chapter = $start_chapter;
      }else{
         $end_chapter = $range['end_chapter'];
      }

      if($range['end_verse'] === "" && $range['start_verse'] === "" ){
        $end_verse = 999;
      }else if($range['end_verse'] === "" && $range['start_verse'] !== ""){
        $end_verse = $start_verse;
      }else{
         $end_verse = $range['end_verse'];
      }

      $endId = str_pad($end_book, 2, '0', STR_PAD_LEFT) . 
            str_pad($end_chapter, 3, '0', STR_PAD_LEFT) .
            str_pad($end_verse, 3, '0', STR_PAD_LEFT);

      $result = new \stdclass;
      $result->start = $startId;
      $result->end = $endId;

      return $result;
  }

  public static function isValidReference($reference){
    
    $ranges = static::stringToReference($reference);
    $ids = static::rangeToIds($ranges[0]);
    $id = (int) $ids->start;
    $verse = BibleVerse::where("code", $id)->first();

    if ( $verse !== NULL){
      return $verse;
    }
    
    return false;
    
  }

}
