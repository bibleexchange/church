<?php namespace App\Bible\Events;

use App\Bible\Events\Event;
use App\Bible\Entities\User;
use Illuminate\Queue\SerializesModels;

class UserPasswordWasChanged extends Event {

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
