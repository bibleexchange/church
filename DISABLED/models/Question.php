<?php namespace App;
 
class Question extends \Eloquent {
	
	protected $table = 'questions';
	
	protected $fillable = ['task_id','question','answer','readable_answer','options','weight','question_type_id'];
	
	public function answers()
    {
        return $this->hasMany('\App\Answer');
    }
	
    public function answered($user_id)
    {
    	return $this->answers()->user($user_id)->latest()->first();
    }
   
	public function study()
	{
	    return $this->belongsTo('\App\Study', 'study_id');
	}	
	
	public function type()
	{
		return $this->belongsTo('\App\QuestionType', 'question_type_id');
	}
	
	
}