<?php

class Request {
	public function __construct(){
		$this->uri =  $_SERVER['REQUEST_URI'];
		$this->protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$this->url = $this->protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
		$this
			->prepareQueryString()
			->prepareParams();
	}

	private function prepareQueryString(){

		$query = explode("&&", $_SERVER['QUERY_STRING']);
		$this->query = [];

		foreach($query AS $p){
			$x = explode("=", $p);
			$name = $x[0];
			if($name !== ""){
				$this->query[$name] = $x[1];
			}
			
		}
		unset($this->query[0]);
		return $this;
	}

		private function prepareParams(){
			$this->paramsString = explode("?",$this->uri)[0];
			$this->params = explode("/", $this->paramsString);
			unset($this->params[0]);
			$this->params = array_values($this->params);
		return $this;
	}
}

?>