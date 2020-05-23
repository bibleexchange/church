<?php namespace App\Handlers\Commands;

use App\Commands\ConfirmUserCommand;
use Illuminate\Queue\InteractsWithQueue;
use App\Helpers\UserRepository;
use App\User;
use App\Events\UserHasConfirmedEmail;

class ConfirmUserCommandHandler {
	
	private $userRepository;
	
	/**
	 * Create the command handler.
	 *
	 * @return void
	 */
	public function __construct(UserRepository $userRepository)
	{
		$this->userRepository = $userRepository;
	}

	/**
	 * Handle the command.
	 *
	 * @param  CreateBibleNoteCommand  $command
	 * @return void
	 */
	public function handle(ConfirmUserCommand $command)
	{
	
		$user = User::confirm($command->confirmation_code);
		
		if($user !== null)
		{
			$this->userRepository->save($user);

			\Event::fire(new UserHasConfirmedEmail($user));
		}
		return $user;
	}
}
