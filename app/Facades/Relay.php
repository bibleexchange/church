<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Relay extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'relay';
	}

}
