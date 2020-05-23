<?php namespace App\Helpers;

use App\BibleVerse;
use stdClass;

class Search {

	public $attributes;

	public function __construct($query)
	{
		$this->attributes = ["q" => $query];

		$this
			->verses()
			->people()
			->recordings()
			->notes()
			->courses();
	}

	private function verses(){
		$this->attributes['verses'] = BibleVerse::findByReference($this->q);
		return $this;
	}

	private function people(){
		$this->attributes['people'] =  [
			["id"=>"idstring","path"=>"pathstring"]
		];
		return $this;
	}

	private function recordings(){
		$this->attributes['recordings'] = \App\Sermon::prepare();
		return $this;
	}

	private function notes(){
		$this->attributes['notes'] = [];
		return $this;
	}

	private function courses(){
		$this->attributes['courses'] = [];
		return $this;
	}

	public function get(){
		return $this->attributes;
	}

	public function __get($name){
		return $this->attributes[$name];
	}

}
