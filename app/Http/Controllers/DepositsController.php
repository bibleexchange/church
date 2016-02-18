<?php namespace Deliverance\Http\Controllers;

use Deliverance\Http\Requests;
use Deliverance\Http\Controllers\Controller;
use Deliverance\Entities\Deposit;
use Deliverance\Entities\Contact;
use Input, Flash,Redirect;
use Illuminate\Http\Request;

class DepositsController extends OfficeController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		return view(
			'office.deposit.index',[
			'pageTitle'=>'Input',
			'accountsSelectList'=> $this->account->selectList(),
			'depositedCurrentDate' => date('Y-m-d'),
			'deposits'=> $this->deposits
			]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{

			$entry = new Deposit;
			$entry->deposited = Input::get('deposited');		
			$entry->account_id = Input::get('account_id');
			$entry->memo = Input::get('memo');
			$entry->save();
		 	
			Flash::message('Deposit successfully started!');
			
			return Redirect::to('office/deposit/'.$entry->id)->with('message', 'Deposit Successfully created!');

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		
		$deposits = $this->deposits;
		$deposit = Deposit::find($id);
		$givers = Contact::orderBy('lastname', 'ASC')->get();

		return view('office.deposit.show',compact('deposit','deposits','givers'));
	}
	
	public function printMe($id)
	{

		$deposit = Deposit::find($id);
	
		return view('office.deposit.print',compact('deposit'));
	}
	
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
