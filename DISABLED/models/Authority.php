<?php namespace App;

use App\Bible\OauthClient;

class Authority extends BaseModel {

  protected $fillable = ['name', 'ifi','mbox'];
  
  protected $appends = array('lrs','account');
  
  public function getAccountAttribute(){
    	return ['name'=>$this->account_name,'homePage'=>$this->account_homePage];
  }

}