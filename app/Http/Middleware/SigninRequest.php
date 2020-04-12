<?php namespace App\Bible\Requests;

use App\Bible\Http\Requests\Request;

class SigninRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'email'    => 'required',
			'password' => 'required'
		];
	}

}
