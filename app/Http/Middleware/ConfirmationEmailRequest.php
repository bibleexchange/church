<?php namespace App\Requests;

use App\Http\Requests\Request;

class ConfirmationEmailRequest extends Request {

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
			'confirmation_code' => 'required|exists:users,confirmation_code'
		];
	}

}
