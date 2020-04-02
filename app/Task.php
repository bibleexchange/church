<?php namespace App;

class Task extends \Eloquent {
	
	protected $fillable = array('title','instructions','study_id','task_type_id','points','orderBy');
	
	public $timestamps = true;	
	
	public function taskType(){
		return $this->belongsTo('\App\TaskType');
	}
	
	public function studies(){
		return $this->belongsToMany('\App\Study','study_task','task_id','study_id');
	}
	
	public function properties()
	{
		return $this->hasMany('\App\TaskProperty','task_id');
	}
	
	public function questions()
	{
		return $this->hasMany('\App\Question','task_id');
	}
	
	public function buildEditor(){

		switch($this->task_type_id){
			
			case 1://Read
				return new \App\Tasks\Read($this);
				break;
			
			case 2://Listen
				return new \App\Tasks\Listen($this);
				break;
			
			case 3://Watch
				return new \App\Tasks\Watch($this);
				break;
						
			case 4://Write
				return new \App\Tasks\Write($this);
				break;
			
			case 5://Review
				return new \App\Tasks\Review($this);
				break;
			
			case 6://Test
				return new \App\Tasks\Test($this);
				break;
			
			case 7://Apply
				return new \App\Tasks\Apply($this);
				break;
			
			case 8://Memorize
				return new \App\Tasks\Memorize($this);
				break;
			
			default:
				return App::abort();
		}
		
	}

	
}