<?php namespace Deliverance\Http\Controllers;

use Deliverance\Entities\Contact;
use Auth, Input, Flash;

class OfficeController extends Controller {

public function __construct() {
	
	$this->middleware('auth');
	
	$this->contact = new \Deliverance\Entities\Contact;
	$this->account = new \Deliverance\Entities\Account;
	$this->deposit = new \Deliverance\Entities\Deposit;
	$this->offering = new \Deliverance\Entities\Offering;
	$this->gift = new \Deliverance\Entities\Gift;
	
	$this->deposits = $this->deposit->orderBy('deposited','DESC')->limit(25)->get();
	
}
	public function getIndex()
	{
		return $this->getDashboard();
	}
	
	public function getPrint()
	{

		return view(
			'office.print',[
			'pageTitle'=>'print',
			'deposits'=>$this->deposit->selectList(),
			'offerings'=>$this->offering->selectList(20),
			]);
	}
		
	public function getDashboard() {
		
		$user = Auth::user();
		
		return view('office.dashboard',[
			'pageTitle'=>'Dashboard',
			'user_first_name'=> $user->firstname,
			'inout_title' => 'Log Out',
			'inout_url' => 'logout',
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return view(
			'office.users.remind',[
			'pageTitle'=>'Register'
			]);
	}

}