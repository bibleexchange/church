<?php namespace App\Bible\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Bible\Core\PresentableTrait;

class Permission extends Model {

	use PresentableTrait;

    protected $fillable = ['name','display_name'];
	
}
