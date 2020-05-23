<?php namespace App\Jobs;

use App\Console\Commands\Command;

class CreateTagCommand extends Command {

	public $name;
	
	public function __construct($name)
	{
		$this->name = $name;
	}


}
