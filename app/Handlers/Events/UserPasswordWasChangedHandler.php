<?php namespace App\Handlers\Events;

use App\Events\UserPasswordWasChanged;
use App\Mailers\UserMailer;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\PasswordReset;

class UserPasswordWasChangedHandler {

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
	public function handle(UserPasswordWasChanged $event)
	{
		$this->mailer->sendPasswordChangedMessageTo($event->user);
		
		PasswordReset::where('user_id',$event->user->id)->delete();
	}

}
