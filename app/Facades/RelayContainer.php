<?php namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class RelayContainer extends Facade {

	protected static function getFacadeAccessor()
	{
		return 'relaycontainer';
	}

}
