<?php namespace App\Http\Controllers\Bible;

class AdminDashboardController extends Controller {

	/**
	 * Admin dashboard
	 *
	 */
	public function getIndex()
	{
        return view('admin.dashboard');
	}

}
