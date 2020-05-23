<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\PresentableTrait;
use Schema;

class UserRole extends Model implements \App\Interfaces\ModelInterface {

	use \App\Traits\ManageTableTrait, PresentableTrait;

	protected $fillable = ['name','description'];

    public function modifySchema($table){

      $table->id();
      $table->string('name');
      $table->string('description')->nullable();

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['roles'];

  }

}
