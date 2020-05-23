<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*
Graphql Routes
*/

Route::group(array('prefix' => '/v1'), function()
{	
	
	Route::get('studies','Api\ApiStudiesController@index');
	Route::get('studies/{study}','Api\ApiStudiesController@show');
	Route::get('studies/{study}/comments','Api\ApiStudiesController@comments');
	Route::post('studies/{study}/comments','CommentsController@store');
	
	
	Route::resource('bookmarks','Api\ApiBookmarksController');
	
	Route::resource('bible','Api\ApiBibleController',['only'=>['index','show','store']]);
	
	Route::get('notes/bible/verse/{verse}','Api\ApiNotesController@bibleVerse');
	Route::get('notes/bible/{book}/{chapter}','Api\ApiNotesController@bibleChapter');
	
	Route::get('notes/@{username}','Api\ApiNotesController@publicProfile');
	Route::get('amens/@{username}','Api\ApiAmensController@publicProfile');
	
	Route::get('notes/array/{array}', 'Api\ApiNotesController@showArrayOfNotes');
	Route::get('amens/array/{array}', 'Api\ApiAmensController@showArrayOfAmens');
	
	Route::get('/views/bible/chapter/{bchapter}', 'Api\ApiBibleController@showChapter');
	
});
