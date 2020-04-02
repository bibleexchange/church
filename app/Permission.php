<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PresentableTrait;

class Permission extends Model {

	use PresentableTrait;

    protected $fillable = ['name','display_name'];
	
}
