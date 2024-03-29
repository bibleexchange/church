<?php namespace App\Services;

use App\Helpers\BibleReference;
use App\Study, App\BibleVerse;
use App\Helpers\Helpers as Helper;

class CustomValidator extends \Illuminate\Validation\Validator {
	
	
	public function validateReference($attribute, $value, $parameters)
	{
				
		if(BibleVerse::find($value)){
			return true;
		}
		
		return BibleReference::isValidReference($value);
		
	}
	
	protected function replaceReference($message, $attribute, $rule, $parameters)
	{		
		$message = 'I can\'t find that Scripture Reference!';
		
		return str_replace(':foo', null, $message);
	}
	
	public function validateUniqueBEStudy($attribute, $value, $parameters)
	{
		
		$title = Helper::userTitleToUrl($value);
		
		if (Study::where('title',$title)->where('namespace_id',1)->exists() === false){
			return true;	
		}
	
	}
	
	protected function replaceUniqueBEStudy($message, $attribute, $rule, $parameters)
	{
		
		$message = 'Titles must be unique and there is already a study by that name.';
	
		return str_replace(':foo', null, $message);
	}
	
}
