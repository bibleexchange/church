<?php namespace Deliverance\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	public $timestamps = false;
	
	protected $fillable = [ 'name'];

}
