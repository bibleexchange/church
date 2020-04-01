<?php namespace App\Bible\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Bible\Core\PresentableTrait;

class Role extends Model {

	use PresentableTrait;

	protected $fillable = ['name'];

}
