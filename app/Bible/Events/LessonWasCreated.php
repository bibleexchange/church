<?php namespace App\Bible\Events;

use App\Bible\Events\Event;

use Illuminate\Queue\SerializesModels;

class LessonWasCreated extends Event {

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
