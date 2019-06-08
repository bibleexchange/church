<?php

class Business {
	
	public function __construct(){
		$this->props = Config::load('business');
	}

	public function __get($name){
		return $this->props->$name;
	}
}

?>