<?php namespace App\Jobs;

use App\Console\Commands\Command;

use Illuminate\Queue\SerializesModels;

class ConfirmUserCommand extends Command {

	use SerializesModels;

    public $confirmation_code;

    function __construct($confirmation_code)
    {		
		$this->confirmation_code = $confirmation_code;
    }

}