<?php

Route::get('/r','Bible\RecordingsController@index');
Route::get('/r/{recording}','Bible\RecordingsController@show')
	->where('recording','(.*)');

Route::group(['prefix' => 'recordings'], function()
{

	Route::get('/','Bible\RecordingsController@index');
	Route::get('/search/{query}', ['uses' => 'Bible\RecordingsController@goToRecording']);
	Route::post('/search', ['uses' => 'Bible\RecordingsController@goToRecording']);
	Route::post('/recording-to-study', ['as' => 'recording-to-study','uses' => 'Bible\RecordingsController@addToStudy']);
	
});

Route::group(['prefix' => 'recording'], function()
{


	Route::get('/create','Bible\RecordingsController@create');
	Route::post('/create','Bible\RecordingsController@store');
	
	Route::get('/edit/{recording}','Bible\RecordingsController@edit');
	Route::post('/edit/{recording}','Bible\RecordingsController@update');
	
	Route::post('/create-format',[
	'uses'=>'Bible\RecordingsController@createFormat',
	'as'=>'create_recording_format'
	]);
	
	
	Route::post('/delete',[
	'uses'=>'Bible\RecordingsController@delete',
	'as'=>'delete_recording'
	]);
	
	Route::post('/delete-format',[
	'uses'=>'Bible\RecordingsController@destroyFormat',
	'as'=>'delete_recording_format'
	]);
	
	Route::post('/add-scripture',[
	'uses'=>'Bible\RecordingsController@addScripture',
	'as'=>'add_scripture_to_recording'
	]);
	
	Route::post('/detach-verse',[
	'uses'=>'Bible\RecordingsController@detachVerse',
	'as'=>'detach_recording_verse'
	]);
	
	Route::post('/attach-person',[
	'uses'=>'Bible\RecordingsController@attachPerson',
	'as'=>'attach_recording_person'
	]);
	Route::post('/detach-person',[
	'uses'=>'Bible\RecordingsController@detachPerson',
	'as'=>'detach_recording_person'
	]);
	
});
