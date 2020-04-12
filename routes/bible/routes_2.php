<?php

Route::get('test','Bible\TestReactController@test');
Route::get('dbmigrate', 'Bible\Tools\DbMigrationController@index');

Validator::resolver(function($translator, $data, $rules, $messages)
{
	return new App\Bible\Services\CustomValidator($translator, $data, $rules, $messages);
});

Route::get('/gallery','Bible\ImagesController@index');
Route::post('/gallery','Bible\ImagesController@copyImageToSession');

Route::get('/images/{src1}/{src2?}/{src3?}/{src4?}','Bible\ImagesController@show');
Route::get('/svg/{src1}/{src2?}/{src3?}/{src4?}','Bible\ImagesController@svg');

Route::get('/resources/{src1}/{src2?}/{src3?}/{src4?}/{src5?}','Bible\ImagesController@wiki');

@include('routes_recording.php');

Route::get('/test-react/{test}', 'Bible\TestReactController@test');

Route::get('/dashboard', ['uses'=>'Bible\UserController@index','as'=>'home']);
Route::get('/home', ['uses'=>'Bible\UserController@index','as'=>'home']);

/*
 * Notes
*/
Route::get('notes', [
	'as' => 'notes_path',
	'uses' => 'Bible\NotesController@index'
]);

Route::post('notes', [
	'as' => 'notes_path',
	'uses' => 'Bible\NoteController@store'
]);

/*
 * Users
*/

Route::get('members', [
'as' => 'users_path',
'uses' => 'Bible\UsersController@index'
]);

Route::get('@{username}', [
'as' => 'profile_path',
'uses' => 'Bible\UsersController@show'
]);

Route::get('@{username}/notes', [
'as' => 'public_notes_path',
'uses' => 'Bible\UsersController@notes'
]);

Route::get('@{username}/notes/{note}', [
'as' => 'public_note_path',
'uses' => 'Bible\UsersController@note'
]);

Route::get('@{username}/amens', [
'as' => 'public_amens_path',
'uses' => 'Bible\UsersController@amens'
]);

Route::get('@{username}/following', [
'as' => 'public_following_path',
'uses' => 'Bible\UsersController@following'
]);

Route::get('@{username}/followers', [
'as' => 'public_followers_path',
'uses' => 'Bible\UsersController@followers'
]);

Route::get('@{username}/studies','Bible\StudiesController@userIndex');
Route::get('@{username}/studies/{user_study}','Bible\StudiesController@studySpace');

Route::get('@{username}/courses','Bible\UserCoursesController@index');

/**
 * Follows
*/
Route::post('follows', [
'as' => 'follows_path',
'uses' => 'Bible\FollowsController@store'
]);

Route::delete('/follows/{id}', [
'as' => 'follow_path',
'uses' => 'Bible\FollowsController@destroy'
]);

/*
 * Password Resets
*/
Route::get('password/remind', 'Bible\RemindersController@getRemind');
Route::post('password/remind', 'Bible\RemindersController@postRemind');
Route::get('password/reset/{token}', 'Bible\RemindersController@getReset')
	->where('token','(.*)');
	
Route::post('password/reset/{token}', 'Bible\RemindersController@postReset')
	->where('token','(.*)');
	
@include('routes_user.php');
@include('routes_user_content.php');

Route::resource('subscribe', 'Bible\UserSubscriptionController');

/*Studies start*/

Route::get('/study','Bible\StudiesController@index');

Route::get('s/',function(){
	return Redirect::to('/study');
});

Route::post('study/search/{query}', ['as' => 'go_to_study','uses' => 'Bible\StudiesController@goToStudy']);
Route::get('study/tag/{tag}', ['uses' => 'Bible\StudiesController@showTag']);

Route::get('study/{study}/test','Bible\TestsController@show');
Route::post('study/{study}/test','Bible\TestsController@store');

Route::get('study/{study}-{sub1?}','Bible\StudiesController@studySpace');

/*Studies end*/

include('routes_admin.php');

include('routes_api.php');

Route::get('/rss', 'Bible\RssController@getIndex');

Route::get('/course/{course}/rss', 'Bible\RssController@getFeed');
Route::get('/course/{course}-{courseTitle}', 'Bible\CoursesController@show');
Route::get('/courses', 'Bible\CoursesController@index');

Route::get('study/{studythis}','Bible\StudiesController@studySpace')
->where('studythis','(.*)');

Route::get('{studythis}','Bible\SearchesController@findSomething')
	->where('studythis','(.*)');
