<?php namespace App\Bible\Facades;

use Illuminate\Support\Facades\Facade;

class Photo extends Facade {

	protected static function getFacadeAccessor()
	{
		return new \App\Bible\Presenters\ImagePresenter;
	}

}