<?php namespace App\Http\Controllers\Bible;

class AdminVideoController extends \ResourceController {
	 
	public function __construct() {
	 
	 $this->Resource = new Video();	 
	
     View::share('Resource',$this->Resource);
	 
	 }
	 
}
