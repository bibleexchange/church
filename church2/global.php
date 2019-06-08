<?php

class Config {

	public function __get($name){
		$path = config_path() . "/" . $name . ".json";
		return json_decode(file_get_contents($path));
	}

	public static function load($json_file){
		$path = config_path() . "/" . $json_file . ".json";
		return json_decode(file_get_contents($path));
	}

}

function dd($var, $var2 = "u1", $var3 = "u1", $var4 = "u1", $var5 = "u1", $var6 = "u1" ){
	if ($var !== "u1") var_dump($var);
	if ($var2 !== "u1") var_dump("<hr/>", $var2);
	if ($var3 !== "u1") var_dump("<hr/>",$var3);
	if ($var4 !== "u1") var_dump("<hr/>",$var4);
	if ($var5 !== "u1") var_dump("<hr/>",$var5);
	if ($var6 !== "u1") var_dump("<hr/>",$var6);
	die;
}

function root_path(){
	return __DIR__;
}

function config_path(){
	return __DIR__ . "/config";
}

$CONFIG = new Config();
$ROUTES = $CONFIG->routes;
//$BUSINESS = $CONFIG->business;

include('app/Request.php');
include('app/Controller.php');
include('app/Model.php');

?>