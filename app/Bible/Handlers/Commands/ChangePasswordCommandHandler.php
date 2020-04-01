<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\ChangePasswordCommand;
use App\Bible\Events\UserPasswordWasChanged;
use App\Bible\Entities\PasswordReset;
use App\Bible\Entities\User;
use App\Bible\Entities\UserRepository;
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
