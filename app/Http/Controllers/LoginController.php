<?php namespace App\Http\Controllers;

use App\Ez\MyForm;

class LoginController extends BaseController {

   public function __construct(){
	$this->forms = new MyForm;
	
	$this->middleware('guest', ['except' => [
		'destroy'
	]]);
		
  }
  
  /**
  * Show the form for creating a new Session
  */
  public function create(){

	  return view('auth');
	
  }

  /**
   * Logout
   **/
  public function destroy(){
	  
    \Auth::logout();
    return \Redirect::to('/');
  }

}
