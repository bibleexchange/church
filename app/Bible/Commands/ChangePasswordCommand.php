<?php namespace App\Bible\Commands;

use App\Bible\Commands\Command;
use App\Bible\Entities\User;

class ChangePasswordCommand extends Command {
	
	public $user;
	public $newPassword;
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct(User $user, $newPassword)
	{
		$this->user = $user;
		$this->newPassword = $newPassword;
	}

}
