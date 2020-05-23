<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use \App\Traits\ManageTableTrait;

class NoteCache extends Model implements \App\Interfaces\ModelInterface
{
	
    use ManageTableTrait;

    protected $fillable = ['body','note_id','created_at','updated_at'];

    public function note()
    {
    	return $this->belongsTo('App\Note','note_id');
    }

    public function modifySchema($table){
      $table->id();
      $table->string('body');
      $table->timeStamps();
      return $table;
  }

}
