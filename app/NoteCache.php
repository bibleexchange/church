<?php namespace App;

class NoteCache extends BaseModel {

    protected $fillable = ['body','note_id','created_at','updated_at'];

    public function note()
    {
    	return $this->belongsTo('App\Note','note_id');
    }

}
