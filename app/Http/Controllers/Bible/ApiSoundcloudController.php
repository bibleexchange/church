<?php namespace App\Http\Controllers\Bible;

class SoundcloudController extends ApiController {
	
	public function __construct(Soundcloud $soundcloud){
		
		$this->sound = $soundcloud;
		
	}

	  public function getIndex()
    {		
		$authURL = $this->sound->getAuthorizeURL();
		return $authURL;
		
    }
	
	  public function getMethod($method,$action)
    {		
		return $this->$method($action);
    }
	
	public function soundcloud($action)
	{
		
	}
	
	public function getSoundcloudCallBack(){
		
	}
}