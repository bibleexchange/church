<?php namespace App\Http\Controllers;

use App\Commands\RegisterUserCommand;
use App\Commands\ConfirmUserCommand;
use App\Events\UserAskedForRegistrationConfirmation;
use App\Requests\CreateAccountRequest;
use App\Requests\ConfirmationEmailRequest;
use Flash, Redirect, Auth, Hash, Input;

class RegistrationController extends Controller {

    /**
     * Constructor
     *
     * @param RegistrationForm $registrationForm
     */
    function __construct()
    {
        $this->middleware('guest',['only' => ['create','store']]);
    }

    /**
	 * Show a form to register the user
	 *
	 * @return Response
	 */
	public function create()
	{		
		return view('auth.create');
	}
	
	public function requestConfirmationEmail()
	{
		if(Auth::check() && Auth::user()->isConfirmed())
		{
			return Redirect::to('/');
		}

		return view('auth.request-confirmation-email');
	}
	
    /**
     * Create a new Bible exchange user.
     *
     * @return string
     */
    public function store(CreateAccountRequest $request)
    {
       
		$user = $this->dispatch(new RegisterUserCommand(request('email'),request('password')));
	
       request()->session('message','We sent you a confirmation email. Please confirm your email.');
       
        Auth::login($user);
       
       return Redirect::to('/');
    }
	
    public function confirmUser($confirmation_code)
    {
		$user = $this->dispatch(new ConfirmUserCommand($confirmation_code));
		
		if(Auth::check() && Auth::user()->isConfirmed())
		{
			request()->session('message','Success! You have confirmed your email.');
			
			return Redirect::to('/');
			
		}else if( ! Auth::check()){
			Flash::warning('That confirmation code does not exist or has expired. Please login and request a new confirmation code.');
			
			return Redirect::to('/register/request-confirmation-email');
		}
		
			Auth::login($user);
			request()->session('message','Email confirmed. Glad to have you as a Bible exchange member!');
		
    }
	
    public function confirmEmailAgain()
    {

    	\Event::fire(new UserAskedForRegistrationConfirmation(Auth::user()));
    	 
    	request()->session('message','Email was resent. Check your inbox.');

    	return Redirect::to('/');
    }
    
}
