<?php namespace App\Handlers\Commands;

use App\Commands\UpdateProfileCommand;
use App\Helpers\UserRepository;
use App\User;
use App\Image;
use App\Events\UserHasUpdatedProfile;

class UpdateProfileCommandHandler {
	
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
	public function handle(UpdateProfileCommand $command)
	{
		
		$user = User::updateProfile(
				$command->firstname, $command->middlename, $command->lastname, $command->suffix, $command->gender, $command->profile_image, $command->location
		);
		
		$this->userRepository->save($user);

		\Event::fire(new UserHasUpdatedProfile($user));

		return $user;
	}
	
}