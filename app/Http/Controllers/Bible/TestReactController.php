<?php namespace App\Http\Controllers\Bible;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bible\Entities\Study;

use Illuminate\Http\Request;

class TestReactController extends Controller {

	public function test()
	{		
		$study = Study::find(4);
		
		return view('react.test',compact('study'));
	}

}
