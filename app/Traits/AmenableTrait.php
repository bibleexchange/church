<?php namespace App\Traits;

trait AmenableTrait {

	public function amens()
	{
		return $this->morphMany('App\Amen','amenable');
	}
    
    public function isAmenedBy(\App\User $user)
    {

    	$amened = $this->amens
    				->where('user_id',$user->id)
    				->where('amenable_type',static::class)
    				->where('amenable_id',$this->id)->lists('id');
        if(count($amened) >= 1){
        	return true;
        }
        
    	return false;
    }
	
}