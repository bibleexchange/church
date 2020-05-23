<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Schema;

class UserNotification extends Model
{
	use \App\Traits\ManageTableTrait;

    public $fillable = ['sender_id','user_id','subject','body','object_id','object_type','is_read','sent_at'];

    public function modifySchema($table){

   	  $table->id();
      $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
      $table->unsignedBigInteger('sender_id');

      $table->string('subject', 128)->nullable();
      $table->text('body')->nullable();

      $table->integer('object_id')->unsigned();
      $table->string('object_type', 128);

      $table->boolean('is_read')->default(0);
      $table->dateTime('sent_at')->nullable();
      $table->timestamps();

      return $table;

  }

  public function afterSchema(){
    Schema::table($this->getTable(), function($table) {
       $table->foreign('sender_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
   });

  }

  public function user(){
    return $this->belongsTo('\App\User');
  }

  public function sender(){
    return $this->belongsTo('\App\User','sender_id');
  }

  public function getSeed(){

    return \Config::get('seeds')['notifications'];

  }
               
}
