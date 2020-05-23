<?php namespace App\Http\Controllers;

use App\Requests\ResetPasswordRequest;
use App\Commands\SendPasswordResetCommand;
use App\Commands\ChangePasswordCommand;
use App\Requests\ChangePasswordRequest;
use App\Helpers\UserRepository;
use App\Helpers\PasswordReset;

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return view('password.remind');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind(ResetPasswordRequest $request)
	{
		
		$email = \request('email');
		
		$this->dispatch(new SendPasswordResetCommand($email));
		
		\Auth::logout();
		
		request()->flash('message','We just emailed a password reset link to '.$email.'.');
		
		return \Redirect::to('/welcome');
	}

	public function postResendConfirmationEmail()
	{

		request()->flash('message','A confirmation email has been resent');
		
		return Redirect::back();

	}
	
	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		
		if (is_null($token) or PasswordReset::where('token',$token)->first() === null){
			
			\request()->session('error','That reset token doesn\'t exist anymore.');
			
			if (\Auth::check()){
			
			return \Redirect::to('/');
			}else {
				return \Redirect::to('/welcome');
			}
		}
		
		return view('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset(ChangePasswordRequest $request)
	{
		$email = \request('email');
		$user = UserRepository::findByEmail($email);
		$newPassword = \request('password');
		
		$this->dispatch(new ChangePasswordCommand($user, $newPassword));
		\Auth::logout();
        request()->flash('message','Your password has been reset. You may now log in.');
		
		return \Redirect::to('/welcome');
		
	}

}
