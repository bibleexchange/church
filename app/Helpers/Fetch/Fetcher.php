<?php namespace App\Helpers\Fetch;

class Fetcher {

	public $model;
	
	public function __construct(){

		$this->user = \Auth::user();
		$this->request = request();
	}

	public function send($model){
		$this->model = $model;
	}
}
