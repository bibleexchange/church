<?php namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\Lesson;
use Auth, Input;

class EditLessonRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		
		$lesson = Lesson::find(Input::get('lesson_id'));

		if (Auth::user()->id === $lesson->user_id){return true;}
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title' => 'required'
		];
	}

}
