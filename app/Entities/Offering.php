<?php namespace Deliverance\Entities;

use Deliverance\Core\MoneyTrait;

class Offering extends \Eloquent {
	
	use MoneyTrait;
	
	protected $fillable = [ 'OfferingName','OfferingMemo' , 'DepositsID'];
	
	public static $rules = array(
	'OfferingName'=> 'AlphaNum',
	'DepositsID'=> 'Integer', 
	'OfferingMemo'=> ''
    );

	public function deposit()
	{
	    return $this->belongsTo('\Deliverance\Entities\Deposit');
	}

 	public function gifts()
    {
        return $this->hasMany('\Deliverance\Entities\Gift');
    }
	
    public static function selectList($limit = NULL)
	{
		
		if (is_null($limit)){
			return \Deliverance\Entities\Offering::orderBy('id','DESC')->get()->lists('name', 'id');
		}else {
			return \Deliverance\Entities\Offering::orderBy('id','DESC')->take($limit)->get()->lists('name', 'id');
			
		}
	}
	
}