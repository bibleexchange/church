<?php namespace Deliverance\Entities;

class Collection extends \Eloquent {
	
	protected $fillable = ['name'];

	protected $table = 'collections';
	
	public function contacts()
	  {
		return $this->belongsToMany('Deliverance\Entities\Contact');
	  }
	
}