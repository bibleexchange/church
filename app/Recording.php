<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImportSql;

class Recording extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

   protected $table = "audios";
   protected $fillable = ['date', 'title', 'memo','bible','theme','genre','contacts_id','created_at' , 'updated_at'];
   protected $dates = ['created_at','updated_at'];

	public function tags()
	{
		return $this->belongsToMany('\App\Tag');
	}

	public function preacher(){
		return $this->belongsTo('\App\Contacts');
	}

	public function persons()
	{//notsure if this is right
		return $this->belongsToMany('\App\Person', 'entity_person','entity_id','person_id')->withPivot('role', 'memo');
	}
	
	public function preachers()
	{//notsure if this is right
		return $this->belongsToMany('\App\Person', 'entity_person','entity_id','person_id')->withPivot('role', 'memo')->where('role','preacher');
	}
	
	public function primaryPerson()
	{
		if($this->preachers->count() >= 1 )
		{
			return $this->preachers->first();
		}else if ($this->persons->count() >= 1){
			return $this->persons->first();
		}
		
		return new \App\Person;
		
	}

 public function modifySchema($table){
      $table->id();
      $table->date('dated');
      $table->string('title');
      $table->string('description');
      $table->string('genre');

      $table->timestamps();

      return $table;
  }

  public function seed(){
  	ImportSql::import([\Config::get('seeds')['RECORDINGS']]);
  }
}

//Person
//EntityPerson

//create migration and seeders for these 3