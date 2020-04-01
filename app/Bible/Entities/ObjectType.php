<?php namespace App\Bible\Entities;

use Illuminate\Database\Eloquent\Model;

class ObjectType extends Model {
	
	protected $table = 'object_types';
	protected $fillable = ['classname'];
	
}
