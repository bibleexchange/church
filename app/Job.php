<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model  {

  use \App\Traits\ManageTableTrait;

  protected $fillable = ['queue','payload','attempts','reserved','reserved_at','available_at','created_at'];

  protected $table = "jobs";

  public function modifySchema($table){

      $table->id();
      $table->string('queue');
      $table->longText('payload');
      $table->tinyInteger('attempts')->unsigned();
      $table->tinyInteger('reserved')->unsigned();
      $table->unsignedInteger('reserved_at')->nullable();
      $table->unsignedInteger('available_at');
      $table->unsignedInteger('created_at');
      $table->index(['queue', 'reserved', 'reserved_at']);

      return $table;
  }

}
