<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model {

	protected $fillable = ['url','meta'];
		
	protected $table = 'links';
	
	protected $appends = [];
	
}
