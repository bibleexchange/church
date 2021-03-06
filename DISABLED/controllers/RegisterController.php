<?php namespace App\Http\Controllers;

use App\Repository\User\UserRepository as User;
use App\Ez\MyForm;

class RegisterController extends BaseController {

  /**
  * User
  */
  protected $user;

  /**
   * Construct
   *
   * @param User $user
   */
  public function __construct(User $user){
	$this->forms = new MyForm;
    $this->user = $user;
	$this->middleware(['guest','registration.status']); 
  }


  public function index(){
	  
	$register_data = $this->forms->register();
	  
	return  view('system.forms.register',compact('register_data'));
  }

  public function store(){

    //event hook to fire and check domain registration
    $event = Event::fire('user.domain_check', array(Input::all()));
    if( $event == false ){
      return Redirect::back()->withErrors('That email address is not premitted.');
    }

    //validate input
    $validator = $this->user->validate( Input::all() );
    if ($validator->fails()){
      return Redirect::back()
      ->withInput(Input::except('password'))
      ->withErrors($validator);
    }

    // Save the user
    $user = $this->user->create(Input::all());

    if($user){
      //event hook to fire upon successful registration
      Event::fire('user.register', array($user));
      // log in new user
      Auth::attempt(array(
        'email'    => Input::get('email'),
        'password' => Input::get('password')
      ));
      return Redirect::to('/')
      ->with('flash', 'The new user has been created');
    }

    return Redirect::to('/');
  }

}