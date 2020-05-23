<?php namespace App\Http\Controllers\Admin;

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
