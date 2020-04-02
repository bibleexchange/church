<?php namespace App\Bible\Events;

use App\Bible\Events\Event;
use App\User;

use Illuminate\Queue\SerializesModels;

class UserRequestedPasswordReset extends Event {

	use SerializesModels;

	public $user;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

}