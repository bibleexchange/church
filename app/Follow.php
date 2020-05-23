<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ManageTableTrait;

class Follow extends Model implements \App\Interfaces\ModelInterface
{
  
    use ManageTableTrait;

    public $fillable = ['follower_id','followed_id'];

    public function modifySchema($table){

      $table->id();
      $table->unsignedBigInteger('follower_id');
      $table->unsignedBigInteger('followed_id');
      $table->timestamps();

      return $table;
  }

  public function followed(){
    return $this->belongsTo('\App\User','followed_id');
  }

  public function follower(){
    return $this->belongsTo('\App\User','follower_id');
  }
}
