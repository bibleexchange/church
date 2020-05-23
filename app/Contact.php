<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public function recording(){
		return $this->hasMany('\App\Recording');
	}

}
