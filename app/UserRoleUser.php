<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRoleUser extends Model {

  protected $fillable = ['user_role_id','user_id'];

  use \App\Traits\ManageTableTrait, 
  \App\Traits\PresentableTrait;

    public function modifySchema($table){

      $table->id();  
      $table->foreignId('user_role_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

      return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['role_user'];

  }
}
