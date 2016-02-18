<?php namespace Deliverance\Mailers;

use Deliverance\Entities\User;

class UserMailer extends Mailer {

    public function sendConfirmMessageTo(User $user)
    {
    	
    	$subject = 'Please Confirm Your Email for Bible exchange';
    	$view = 'emails.confirm';
    	$data = ['confirmation_code'=>$user->confirmation_code];
    
    	return $this->sendTo($user, $subject, $view, $data);
    }

    public function sendWelcomeMessageTo(User $user)
    {
    	$subject = 'Welcome to Bible exchange!';
    	$view = 'emails.welcome';
    	$data = [];
    
    	return $this->sendTo($user, $subject, $view, $data);
    }
}

