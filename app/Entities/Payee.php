<?php namespace Deliverance\Entities;

use Illuminate\Database\Eloquent\Model;

class Payee extends Model {
	
	public $timestamps = true;
	
	protected $fillable = [ 'name','address', 'contact'];

}
