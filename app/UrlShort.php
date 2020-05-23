<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlShort extends Model {

   use \App\Traits\ManageTableTrait;

	protected $fillable = ['url','redirect','hits'];
	
	private $relatedObject = null;
	
    public function getDates()
    {
        return ['created_at', 'updated_at'];
    }

    public function modifySchema($table){

      $table->id();
      $table->string('url');
      $table->string('redirect');
      $table->integer('hits')->unsigned();
      $table->timeStamps();

      return $table;

  }

  public function getSeed(){
    return \Config::get('seeds')['url_shorts'];
  }

}
