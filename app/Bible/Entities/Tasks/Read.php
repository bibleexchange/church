<?php namespace App\Bible\Entities\Tasks;

use App\Bible\Entities\Task;
use App\Bible\Entities\Study;

class Read {

	public $template;
	
	public function __construct($task){
	
		$this->model = $task;
		$this->templates = new \stdClass();
		$this->templates->edit = 'studies.tasks.read.edit';
		
		return $this;
	
	}
	
}