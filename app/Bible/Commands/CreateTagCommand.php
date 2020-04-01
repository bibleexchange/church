<?php namespace App\Bible\Commands;

use App\Bible\Commands\Command;

class CreateTagCommand extends Command {

	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}


}
