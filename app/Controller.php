<?php

class Controller {

	public function __construct(){
		$this->business = new Business();
	}

	public function render($sub_page, $replace = [], $main = "template.php"){
		$template =file_get_contents(view_path() . "/" . $main);
		$body_template = file_get_contents(view_path() . "/" . $sub_page);

		$r = [];

		foreach($replace AS $K=>$V) {
			$key = "$" . $K;
			$r[$key] = $V;
		}

		$r['$body'] = strtr($body_template, $r);
		$replace2 = strtr($template, $r);
		
		return $replace2;
	}

	public function home($request){

		return $this->render("pages/home.php", [
				'page_title' => "Home",
				'business_name' => $this->business->name,
				'header' => file_get_contents(view_path() . "/header.php")
		]);
	}

	public function blog($request){
		$entries = '';

		foreach(Config::load('posts') AS $d){
			$entries .= '<li><a href="/blog/'.$d->id.'">'.$d->title.'</a></li>';
		}

		return $this->render("pages/blog_index.php", [
				'page_title' => "Blog",
				'business_name' => $this->business->name,
				'entries' => $entries
		]);
	}	

	public function editBlog($request){

		return $this->render("pages/edit_blog.php", [
				'page_title' => "Home",
				'business_name' => $this->business->name,
				'text' => file_get_contents(config_path() . "/posts.json"),
		]);
	}

	public function editBlogUpdate($request){
		file_put_contents(config_path() . "/posts.json", $request->post["data"]);
		return redirect("/edit/blog");
	}

	public function post($request){

		$page_title = "Blog Post";
		$business = new Business();
		$business_name = $business->name;
		$Parsedown = new Parsedown();
		$template =file_get_contents(view_path() . "/template.php");
		$body = $Parsedown->text(file_get_contents(posts_path() . "/".$request->params[1].".php"));

		$replace2 = strtr($template, 
			[ 
				'$page_title' => $page_title,
				'$body' => $body,
				'$business_name' => $business_name
			]
		);
		
		return $replace2;
	}	

	public function editPost($request){

		$path = posts_path() . "/" . $request->params[2] . ".php";

		if($request->method === "POST"){
			file_put_contents($path, $request->post["data"]);
			return redirect("/edit/post/" . $request->params[2]);
		}else{
			$Parsedown = new Parsedown();
			$myfile = fopen($path, "a");
			fclose($myfile);
			$text = file_get_contents($path);
			
			return $this->render("pages/edit_post.php", [
				'page_title' => "Editor",
				'business_name' => $this->business->name,
				'text' => $text,
				'uuid' => $request->params[2],
				'output' => $Parsedown->text($text)
			]);

		}

		

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