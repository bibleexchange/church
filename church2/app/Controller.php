<?php

class Controller {
	public function home($request){
		$page_title = "Home";
		$business = new Business();
		$business_name = $business->name;

		$template =file_get_contents("../views/template.php");
		$body_template = file_get_contents("../views/pages/home.php");

		$body = strtr($body_template, 
			[ 
				'$business_name' => $business_name
			]
		);

		$replace2 = strtr($template, 
			[ 
				'$page_title' => $page_title,
				'$body' => $body
			]
		);
		
		return $replace2;
	}


}

class TestController {
	public function test($request){
		dd("test", $request);
	}

	public function test2($request){
		dd("test2", $request);
	}

}
?>