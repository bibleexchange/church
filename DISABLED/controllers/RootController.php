<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RootController extends Controller {

    function __construct()
    {
        $this->middleware('auth');   
    }

	public function index()
	{
		$site = \App\Site::first();

		//if super admin, show site dashboard, otherwise show list of LRSs can access	
		if( \Auth::user()->can('VIEW_DASHBOARD') ){
		  return \Redirect::route('site.index');
		}else{
		  $lrs = \Auth::user()->lrs;
			
		  return  view('partials.lrs.list',[
		  'lrs' => $lrs, 'list' => $lrs, 'site' => $site
		  ]);
		}
	}

}
