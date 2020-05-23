<?php namespace App;

class RecordingTag extends BaseModel {

	protected $table = 'recording_verse';
		
	protected $fillable = [ 'recording_id','tag_id'];
	
	public $timestamps = false;
	
	public function recording()
	{
	    return $this->belongsTo('App\Recording', 'recording_id');
	}
	
	public function tag()
	{
	    return $this->belongsTo('App\Tag', 'tag_id');
	}

	\DB::unprepared(file_get_contents(Config::get('database')['seeds']['SEED_RECORDING_TAG']));
}
