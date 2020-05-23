<?php namespace App;

class LrsUser extends BaseModel {
  public $timestamps = false;
  protected $table = 'lrs_user';
  protected $fillable = ['lrs_id', 'user_id', 'role_id'];
  
  public function lrs() {
    return $this->belongsTo('\App\Lrs');
  }
  
  public function member() {
    return $this->belongsTo('\App\User');
  }
  
  public function role() {
    return $this->belongsTo('\App\Role');
  }
  
}