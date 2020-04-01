<?php namespace App\Bible\Core;

trait ShortableTrait {

	public function shorts()
	{
		return $this->morphMany('App\Bible\Entities\UrlShort','shortable');
	}
		
}