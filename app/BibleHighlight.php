<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use stdClass;

class BibleHighlight extends Model {
	
	use \App\Traits\ManageTableTrait;

	protected $table = 'bible_highlights';

	protected $fillable = ['bible_verse_id','user_id','color_id'];
	
	public static function user()
	{
		return $this->belongsTo();
	}
	
	public static function verse()
	{
		return $this->belongsTo();
	}

	public function color(){
		
		$colors = static::getColors();
		
		$names = new stdClass();
		$names->id = $this->color_id;
		$names->strong = $colors[$this->color_id]['strong'];
		$names->subtle = $colors[$this->color_id]['subtle'];
		$names->category = $colors[$this->color_id]['category'];
		
		return $names;
		
	}
	
	public static function make($bible_verse_id, $user_id, $color_id)
	{
		
		$user = User::find($user_id);
		$highlight = $user->highlights()->where('bible_verse_id', $bible_verse_id)->first();
		
		if($highlight === null){
			$highlight = new static(compact('bible_verse_id','user_id','color_id'));
		} else {
			$highlight->color_id = $color_id;
		}
		
		return $highlight;
	}
	
	public static function getColors(){
		$colors = [
			['id'=>0,'strong'=>'rgba(0,0,0,0)','category'=>'none','subtle'=>'rgba(0,0,0,0)'],
			['id'=>1,'strong'=>'rgba(255,64,86,.03)','category'=>'primary','subtle'=>'rgba(255,64,86,.1)'],
			['id'=>2,'strong'=>'rgba(0,110,189,.03)','category'=>'secondary','subtle'=>'rgba(0,110,189,.1)'],
			['id'=>3,'strong'=>'rgba(255,182,87,.07)','category'=>'memorization','subtle'=>'rgba(255,182,87,.1)'],
			['id'=>4,'strong'=>'rgba(0,201,137,.03)','category'=>'promises','subtle'=>'rgba(0,201,137,.1)']
		];
		
		return $colors;
	
	}

	 public function modifySchema($table){
      $table->id();
      $table->integer('color_id')->unsigned();
      $table->smallInteger('bible_verse_id')->unsigned();
      $table->foreign('bible_verse_id')->references('id')->on('bible_verses')->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

	  $table->timeStamps();

      return $table;

  }

  public function getSeed(){
 	return \Config::get('seeds')['bible_highlights'];
  }

}
