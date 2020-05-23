<?php

Route::group(array('prefix' => 'user/content', 'before' => 'auth'), function()
{
	Route::get('evernote','EvernoteController@index');
	Route::get('evernote/{notebook_guid}','EvernoteController@show');
	Route::get('evernote/note/{note_guid}','EvernoteController@showNote');
	Route::get('evernote/search/{search_term}','EvernoteController@search');
	Route::post('evernote','EvernoteController@send');
});

