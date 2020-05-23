<?php namespace App\Requests;

use App\Http\Requests\Request;
use Auth;

class UpdateBERecordingRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		if(Auth::user() !== null && Auth::user()->allowed('edit_be_recording')){ return true; }
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'min:3',
			'dated' => 'date',
		];
	}

}
