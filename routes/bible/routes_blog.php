<?php

Route::group(array('prefix' => '/blog'), function()
{	
	Route::get('/','Bible\BlogController@index');
	Route::get('/{article_slug}','Bible\BlogController@index');
	
	Route::get('/tag/{tag}','Bible\BlogController@tagIndex');
	
});
