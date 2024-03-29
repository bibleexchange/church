<?php namespace App\Handlers\Events;

use App\Events\UserWasRegistered;
use App\Mailers\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendRegistrationConfirmation implements ShouldQueue {
	
	use InteractsWithQueue;
	
	 /**
     * @var UserMailer
     */
    private $mailer;

    /**
     * @param UserMailer $mailer
     */
    public function __construct(UserMailer $mailer)
    {
        $this->mailer = $mailer;
    }

	/**
	 * Handle the event.
	 *
	 * @param  UserWasRegistered  $event
	 * @return void
	 */
	public function handle(UserWasRegistered $event)
	{		
		$this->mailer->sendConfirmMessageTo($event->user);
	}

}
