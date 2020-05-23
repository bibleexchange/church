<?php namespace App\Http\Controllers\Admin;

use App\Video;

class AdminVideoController extends \ResourceController {
	 
	public function __construct() {
	 
	 $this->Resource = new Video();	 
	
     View::share('Resource',$this->Resource);
	 
	 }
	 
}
