<?php namespace App\Bible\Handlers\Commands;

use App\Bible\Commands\UpdateProfileCommand;
use App\Bible\Entities\UserRepository;
use App\Bible\Entities\User;
use App\Bible\Entities\Image;
use App\Bible\Events\UserHasUpdatedProfile;

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