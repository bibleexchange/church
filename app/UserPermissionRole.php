<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPermissionRole extends Model {

  use \App\Traits\ManageTableTrait;

  protected $fillable = ['role_id','permision_id'];
  protected $table = "permission_role";

  public function modifySchema($table){

    $table->id();
    $table->foreignId('user_role_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
    $table->foreignId('user_permission_id')->constrained()->onDelete('cascade')->onUpdate('cascade');

    return $table;

  }

  public function getSeed(){

    return \Config::get('seeds')['permission_role'];

  }
}
