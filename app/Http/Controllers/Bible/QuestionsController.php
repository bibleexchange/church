<?php namespace App\Http\Controllers\Bible;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input, Redirect;
use Illuminate\Http\Request;

use App\Question;

class QuestionsController extends Controller {

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($study, $task)
	{
		
		$question = Question::create([
				'task_id'=>$task->id,
				'question'=>request('question'),
				'answer'=>request('answer'),
				'readable_answer'=>request('readable_answer'),
				'options'=>request('options'),
				'weight'=>request('weight'),
				'question_type_id'=>request('question_type_id')
		]);
		$question->save();
		
		return Redirect::back();
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($study, $task)
	{
		$question = Question::find(request('question_id'));
		
		$question->update([
				'task_id'=>$task->id,
				'question'=>request('question'),
				'answer'=>request('answer'),
				'readable_answer'=>request('readable_answer'),
				'options'=>request('options'),
				'weight'=>request('weight'),
				'question_type_id'=>request('question_type_id')
		]);
		
		$question->save();
		
		return Redirect::back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
