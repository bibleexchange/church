<?php namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Bible\BibleVerse;

class ResourceCrossReference extends BaseModel {

	protected $table = 'resource_cross_reference';
	protected $fillable = ['resource_id','section_id','reference'];
	protected $appends = array();

	public function resource(){
		return $this->belongsTo('App\Resource','resource_id');
	}		

}
