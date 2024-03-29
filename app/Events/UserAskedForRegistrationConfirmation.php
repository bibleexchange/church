<?php namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\User;

class UserAskedForRegistrationConfirmation extends Event {

	use SerializesModels;

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
