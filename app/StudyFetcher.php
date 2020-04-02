<?php namespace App;

use Illuminate\Database\Eloquent\Collection;
use App\Study as Study;
use App\Bible\Helpers\Helpers as Helper;
use DB;

class StudyFetcher {

	public $study;
	
	public function __construct($pathArray){
		
		if(isset($pathArray['study'])){
			$this->model($pathArray['study']);
		}else {
			$this->findBEStudyByPath($pathArray);
		}
		
	}
	
	public function sendStudy($study){
		$this->study = $study;
	}
	
	public function model($study){
        $study = Study::find($study);
		$this->sendStudy($study);
	}
	
	public function findBEStudyByPath($pathArray){
		
		$title = str_replace('study/','',implode("/", $pathArray));

		$study = (new Study)
			->where('namespace_id', 1)
			->where('title',Helper::userTitleToUrl($title))
			->first();

		if(is_null($study) ){
			$study = new Study;
			$study->exists = false;
		}
		
		if($title === ""){
			$study->title = "Main Study Page";
		}else{
			$study->title = Helper::dbTitleToHumanReadable($title);
		}

		$this->sendStudy($study);
		
	}

}