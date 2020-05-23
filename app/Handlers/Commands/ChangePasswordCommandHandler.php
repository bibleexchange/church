<?php namespace App\Handlers\Commands;

use App\Commands\ChangePasswordCommand;
use App\Events\UserPasswordWasChanged;
use App\PasswordReset;
use App\User;
use App\Helpers\UserRepository;
use Illuminate\Queue\InteractsWithQueue;

class ChangePasswordCommandHandler {

	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}

	/**
	 * Handle the command.
	 *
	 * @param  ChangePasswordCommand  $command
	 * @return void
	 */
	public function handle(ChangePasswordCommand $command)
	{		
		$command->user->setPasswordAttribute($command->newPassword);
		$this->repository->save($command->user);

		\Event::fire(new UserPasswordWasChanged($command->user));
		
	}

}
