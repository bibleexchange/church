<?php namespace App\Tasks;

use App\Task;
use App\Study;

class Read {

	public $template;
	
	public function __construct($task){
	
		$this->model = $task;
		$this->templates = new \stdClass();
		$this->templates->edit = 'studies.tasks.read.edit';
		
		return $this;
	
	}
	
}