<?php namespace App\Handlers\Events;

use App\Events\UserRequestedPasswordReset;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Mailers\UserMailer;

class SendPasswordReset {
	
	private $mailer;
	
	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	
	public function __construct(UserMailer $mailer)
	{
		$this->mailer = $mailer;
	}

	/**
	 * Handle the event.
	 *
	 * @param  UserRequestedPasswordReset  $event
	 * @return void
	 */
	public function handle(UserRequestedPasswordReset $event)
	{
		$this->mailer->sendResetPasswordMessageTo($event->user);
	}

}