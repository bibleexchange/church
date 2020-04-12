<?php namespace App\Http\Controllers\Bible;

use Input, Auth, Flash, Redirect;

class SessionsController extends Controller {

	/**
	 * @var SignInForm
	 */
	private $signInForm;

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest',['except' => ['destroy']]);
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('welcome');
	}
	
	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(\App\Http\Requests\SigninRequest $request)
	{
		$formData = Input::only('email', 'password');
		
		if ( ! Auth::attempt($formData, request('remember')))
		{
			request()->session('error','We were unable to sign you in. Please check your credentials and try again!');
	
			return Redirect::back()->withInput();
		}
	
		request()->session('message','Welcome back!');
		
		if (request('redirect') !== null && ! Auth::user()->isConfirmed())
		{
			return Redirect::to(request('redirect'));
		}
		
		return Redirect::intended('/');
	}
	
	/**
	 * Log a user out of BibleExchange.
	 *
	 * @return mixed
	 */
	public function destroy()
	{
		Auth::logout();
	
		request()->flash('message','You have now been logged out.');
	
		return Redirect::back();
	}
	
}