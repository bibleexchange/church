<?php namespace Deliverance\Http\Controllers;

use Deliverance\Http\Requests;
use Deliverance\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Deliverance\Entities\Expense;
use Input, Redirect;

class ExpensesController extends OfficeController {

	function __construct(){
		$this->model = new Expense;
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
 public function index($filter = NULL)
    {
		
    	$range = ['2015-01-01','2015-12-31'];

    	if (isset($_GET['range_start']) && isset($_GET['range_end'])){
    		$range = [$_GET['range_start'],$_GET['range_end']];
    	}
    	
    	$datesFromRangeArray = \Deliverance\Helpers\OfficeHelper::createDateRangeArray($range);
    	
		$expenses = Expense::orderBy('created_at','DESC')->whereBetween('created_at',$range)->get();
    	$accounts = \Deliverance\Entities\Account::lists('title','id');

        return view('office.expenses.index',compact('expenses','accounts'));
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
		dd(Input::all());
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{

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
		dd(Input::all());
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
