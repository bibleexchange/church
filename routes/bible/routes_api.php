<?php

Route::group(array('prefix' => '/api/v1'), function()
{	
	Route::get('studies/{id}/tags','Bible\Api\ApiTagsController@index');
	
	Route::get('studies','Bible\Api\ApiStudiesController@index');
	Route::get('studies/{study}','Bible\Api\ApiStudiesController@show');
	Route::get('studies/{study}/comments','Bible\Api\ApiStudiesController@comments');
	Route::post('studies/{study}/comments','Bible\CommentsController@store');
	
	Route::resource('tags','Bible\Api\ApiTagsController',['only'=>['index','show','store']]);
	Route::resource('bookmarks','Bible\Api\ApiBookmarksController');
	
	Route::resource('bible','Bible\Api\ApiBibleController',['only'=>['index','show','store']]);
	
	Route::get('notes/bible/verse/{verse}','Bible\Api\ApiNotesController@bibleVerse');
	Route::get('notes/bible/{book}/{chapter}','Bible\Api\ApiNotesController@bibleChapter');
	
	Route::get('notes/@{username}','Bible\Api\ApiNotesController@publicProfile');
	Route::get('amens/@{username}','Bible\Api\ApiAmensController@publicProfile');
	
	Route::get('notes/array/{array}', 'Bible\Api\ApiNotesController@showArrayOfNotes');
	Route::get('amens/array/{array}', 'Bible\Api\ApiAmensController@showArrayOfAmens');
	
	Route::get('/views/bible/chapter/{bchapter}', 'Bible\Api\ApiBibleController@showChapter');
	
});
