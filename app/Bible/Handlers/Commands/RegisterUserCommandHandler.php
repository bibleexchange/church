<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\RegisterUserCommand;
use Illuminate\Queue\InteractsWithQueue;
use App\Bible\Entities\UserRepository;
use App\Bible\Entities\User;
use Event;
use App\Bible\Events\UserWasRegistered;

class RegisterUserCommandHandler {
	
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
	public function handle(RegisterUserCommand $command)
	{
	
		$user = User::register($command->email, $command->password);
	
		$this->userRepository->save($user);

		Event::fire(new UserWasRegistered($user));

		return $user;
	}
}
