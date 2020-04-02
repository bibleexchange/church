<?php namespace App\Bible\Providers;

use App\Bible\Events\Event;

use Illuminate\Queue\SerializesModels;

class UserRequestedPasswordReset extends Event {

	use SerializesModels;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

}