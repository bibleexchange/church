<?php namespace App;

use App\Traits\PresentableTrait;
use App\Bible\Core\AmenableTrait;
use App\Bible\Core\CommentableTrait;
use GrahamCampbell\Markdown\Facades\Markdown;
use App\Bible\BibleVerse;
use App\Bible\Note;
use App\Bible\NoteCache;
use Symfony\Component\Debug\Exception;

use stdClass;

class Quiz extends BaseModel {

    protected $fillable = ['title','raw_questions','solution','lesson_id','created_at','updated_at'];
    protected $appends = ['questions'];

  public function lesson()
  {
    	return $this->belongsTo('App\Lesson','lesson_id');
  }

 public function getQuestionsAttribute()
  {
      return $this->raw_questions;
  }

}