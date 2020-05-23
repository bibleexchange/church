<?php namespace App\Helpers\Fetch;

class ClassromSeriesCourseLesson extends Fetcher {

	$this->id = 'lesson';
	$this->class = \App\ClassroomSeriesCourseLesson::class;

	private function findByPath($pathArray){
		
		$title = str_replace($this->id.'/','',implode("/", $pathArray));

		$data = (new $this->class)
			->where('title',Helper::userTitleToUrl($title))
			->first();

		if(is_null($data) ){
			$data = new $this->class;
			$data->exists = false;
		}
		
		if($title === ""){
			$data->title = "Main Study Page";
		}else{
			$data->title = Helper::dbTitleToHumanReadable($title);
		}

		$this->send($data);
		
	}

	public function model($model_id){
		$this->send($this->class::find($model_id));
	}
}
