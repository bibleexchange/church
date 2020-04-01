<?php namespace App\Bible\Requests;

use App\Bible\Http\Requests\Request;
use Auth;

class CreateBEStudyRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(Auth::user() !== null ){ return true; }
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		
		return [
			'title' => 'required|min:3'
		];
	}

}
