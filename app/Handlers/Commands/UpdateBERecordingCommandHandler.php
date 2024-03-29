<?php namespace App\Handlers\Commands;

use App\Commands\UpdateBERecordingCommand;
use Illuminate\Queue\InteractsWithQueue;
use App\Recording;

class UpdateBERecordingCommandHandler {
    
	function __construct()
    {

    }

	/**
	 * Handle the command.
	 *
	 * @param  UpdateBeRecordingCommand  $command
	 * @return void
	 */
	public function handle(UpdateBERecordingCommand $command)
	{
		
		$recording = $command->recording;
		$recording->date = $command->date;
		$recording->dated = $command->dated;
        $recording->description = $command->description; 
       	$recording->genre =  $command->genre;
		$recording->title = $command->title;
    	$recording->save();
        
        return $recording;
	}

}