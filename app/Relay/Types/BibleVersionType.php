<?php namespace App\Relay\Types;

use App\Relay\Support\RelayTypeInterface;

use GraphQL\Type\Definition\EnumType;
use App\Relay\Support\TypeResolver;
use App\Bible AS BibleModel;

class BibleVersionType extends EnumType {

 public function __construct(TypeResolver $typeResolver)
    {
	$values = [];

	$versions = BibleModel::get(['id','abbreviation', 'version','copyright']);	
	
	foreach($versions AS $v){
	  $values[$v->abbreviation] = ['value'=>$v->id, 'description'=>$v->version . ' [' . $v->copyright . ']'];
	}

	return parent::__construct([
            'name' => 'bibleVersion',
            'description' => 'One of the available versions of the Bible.',
            'values' => $values
        ]);
    }

}

