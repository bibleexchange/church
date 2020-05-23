<?php

/*
I like this definition from Davenport and Prusak:

--domain

--Knowledge is a high-value form of information 
	that is ready to apply to decisions and actions, [and that] knowledge derives 
		from --information as information derives 
			from --data.

This is extremely important, as I’ve often seen knowledge-sharing 

connected data:

'data point'

Entities (ProperNoun) -->(connected to through relationship) --> Entities (ProperNoun)

RelationshipTypes:
	- 1to1, 1tomany, manytomany

EntityTypes (CommonNoun): (ID, NOUN, AMBIG, =>propsdefinedbyclass )
	- Person  -God -Person -Angels
	- Place
	- Thing:  -Recording -Image -Date -BibleVerse -Event
	- Idea 	  - faith -love
	- Time
*/

namespace App;

use Illuminate\Database\Eloquent\Model;

class Connections extends Model implements \App\Interfaces\ModelInterface
{
   use \App\Traits\ManageTableTrait;

   protected $fillable = ['entity_id','entity_type','entity_role','connection_id','connection_type'];
   protected $dates = ['created_at','updated_at'];

 public function modifySchema($table){
      $table->id();
      $table->unsignedBigInteger('entity_id');
      $table->string('entity_type');
      $table->string('entity_role');

      $table->unsignedBigInteger('connection_id');
      $table->string('connection_type');

      $table->timestamps();

      return $table;
  }

  public function seed(){
  	ImportSql::import([\Config::get('seeds')['RECORDINGS']]);
  }

}