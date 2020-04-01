<?php

Route::group(array('prefix' => 'user/content', 'before' => 'auth'), function()
{
	Route::get('/','Bible\UserContentController@index');
	
	Route::get('evernote','Bible\EvernoteController@index');
	
	Route::get('evernote/{notebook_guid}','Bible\EvernoteController@show');
	Route::get('evernote/note/{note_guid}','Bible\EvernoteController@showNote');
	Route::get('evernote/search/{search_term}','Bible\EvernoteController@search');
	
	Route::post('evernote','Bible\EvernoteController@send');
		
});

