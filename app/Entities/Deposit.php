<?php namespace Deliverance\Entities;

use Deliverance\Core\MoneyTrait;
use DB;

class Deposit extends \Eloquent {
	
	use MoneyTrait;
	
	protected $fillable = ['deposited','account_id','memo'];


public static $rules = array(
    'deposited'=> array('required', 'regex:/\b\d{4}[-.]?\d{2}[-.]?\d{2}\b/'),
    'account_id'=>'integer|exists:accounts,id',
    'memo'=>''
    );

public function account()
	{
	    return $this->belongsTo('Deliverance\Entities\Account');
	}

 public function offerings()
    {
		return $this->hasMany('Deliverance\Entities\Offering');
    }

public function gifts()
    {
    	return $this->hasManyThrough('Deliverance\Entities\Gift', 'Deliverance\Entities\Offering');
    }

	public function getDateAndAccountAttribute()
	{
	    return $this->deposited .' ('. $this->account->title.')';
	}
	
	public static function selectList()
	{
	    return Deposit::orderBy('id','DESC')->get()->lists('DateAndAccount', 'id');
	}

}