<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PresentableTrait;

class UserPermission extends Model {

	use PresentableTrait, \App\Traits\ManageTableTrait;

    protected $fillable = ['name','display_name'];
	
	public function modifySchema($table){

    $table->id();
    $table->string('name');
    $table->string('display_name');
    return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['permissions'];

  }
}
