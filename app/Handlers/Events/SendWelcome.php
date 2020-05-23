<?php namespace App\Handlers\Events;

use App\Events\UserHasConfirmedEmail;
use App\Mailers\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;

class SendWelcome implements ShouldBeQueued  {

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
	 * @param  UserHasConfirmedEmail  $event
	 * @return void
	 */
	public function handle(UserHasConfirmedEmail $event)
	{		
		$this->mailer->sendWelcomeMessageTo($event->user);
	}

}
