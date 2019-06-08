<?php

include('global.php');

$request = new Request();
$match = false;
$cont = true;

//$pattern = '/^\/' . $ROUTES[2][0] . '$/';
//dd($pattern);

foreach($ROUTES AS $r){
	$pattern = '/^\/' . $r[0] . '$/';
   if($cont && preg_match($pattern, $request->paramsString) ){
   	$match = $r;
   	$cont = false;
   }  
}

$call = explode("@",$match[1]); 
$controller = new $call[0];
$child_method = $call[1];

echo $controller->$child_method($request);

?>