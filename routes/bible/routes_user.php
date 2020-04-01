<?php

Route::group(array('prefix' => 'user', 'before' => 'auth'), function()
{

	Route::get('notes', 'Bible\UserController@getNotes');
	Route::get('notes/{note}/show', 'Bible\NoteController@show');
	Route::get('note/{note}/delete', 'Bible\NoteController@delete');
	Route::get('notes/data', 'Bible\NotesController@data');
	
	Route::get('comment/{comment}/delete', 'Bible\CommentsController@delete');

	Route::post('settings', ['use'=>'Bible\UserSettingsController@store','as'=>'settings_path']);
	Route::post('profile-image-delete', 'Bible\UserSettingsController@deleteProfileImage');
	
	Route::resource('settings', 'Bible\UserSettingsController');
	
	
	Route::get('bookmarks/{bookmark}/delete', 'Bible\UserBookmarksController@delete');
	Route::post('bookmarks', 'Bible\UserBookmarksController@store');
	Route::get('bookmarks/data', 'Bible\UserBookmarksController@data');
	Route::resource('bookmarks', 'Bible\UserBookmarksController');
	
	Route::post('highlight', ['as'=>'highlight_verse','uses'=>'Bible\UserHighlightsController@store']);
	
	Route::post('courses','Bible\UserCoursesController@store');
	
	/*
	 * Amens
	 */
	Route::post('amens', [
	'as' => 'amens_path',
	'uses' => 'Bible\AmensController@store'
	]);
	
	Route::delete('amens/{id}', [
	'as' => 'amen_path',
	'uses' => 'Bible\AmensController@destroy'
	]);
	
	/*
	 * User Notifications
	 */
	Route::get('notifications', [
	'as' => 'notifications_path',
	'uses' => 'Bible\UserNotificationsController@index'
	]);
	
	Route::post('notifications', [
		'as' => 'read_notifications_path',
		'uses' => 'Bible\UserNotificationsController@userReadNotifications'
	]);
	
	/*
	 * Study Maker
	 */
	
	Route::get('study-maker','Bible\UserStudiesController@index');
	Route::post('study-maker', ['as' => 'go_to_user_study','uses' => 'Bible\UserStudiesController@goToStudy']);
	
	Route::get('study-maker/{name}/create', [
			'uses'=>'Bible\StudiesController@create',
			'as'=>'create_study'
			])
			->where('name','(.*)');
	Route::post('study-maker/{name}/create', [
			'uses'=>'Bible\StudiesController@store',
			'as'=>'create_study'
			])
			->where('name','(.*)');
	
	Route::get('/study-maker/{study}','Bible\StudiesController@edit');
	Route::get('/study-maker/{study}/edit','Bible\StudiesController@edit');
	Route::post('/study-maker/{study}/edit','Bible\StudiesController@update');
	Route::post('/study-maker/{study}/publish','Bible\StudiesController@publish');
	Route::post('/study-maker/{study}/privatize','Bible\UserStudiesController@hideOrShow');
	Route::get('/study-maker/{study}/preview','Bible\StudiesController@preview');
	
	Route::post('/study-maker/upload-text-file','Bible\StudiesController@uploadTextFile');
	Route::post('/study-maker/{study}/update-main-verse','Bible\StudiesController@updateMainVerse');
	Route::post('/study-maker/{study}/update-tags','Bible\TagsController@update');
	Route::post('/study-maker/{study}/update-description','Bible\StudiesController@updateDescription');
	Route::post('/study-maker/{study}/upload-study-icon','Bible\StudiesController@updateStudyIcon');
	Route::post('/study-maker/{study}/edit-title','Bible\StudiesController@updateTitle');
	Route::post('/study-maker/{study}/recording/{recording}/detach','Bible\StudiesController@detachRecording');
	
	Route::post('study-maker/{study}/create-task','Bible\StudiesController@storeTask');
	Route::post('study-maker/{study}/task/{task}/update','Bible\StudiesController@updateTask');
	Route::get('study-maker/{study}/task/{task}/edit','Bible\StudiesController@editTask');
	
	Route::post('study-maker/{study}/task/{task}/store-question','Bible\QuestionsController@store');
	Route::post('study-maker/{study}/task/{task}/update-question','Bible\QuestionsController@update');
	
	Route::post('course-maker/attach-task-property',[
		'uses'=>'Bible\StudiesController@attachTaskProperty',
		'as' => 'attach_study'
				]);
	
	/*
	 * Course Maker
	 */
			
	Route::get('course-maker','Bible\CourseMakerController@index');
	Route::post('course-maker','Bible\CourseMakerController@store');
	Route::post('/course-maker/{course}/publish','Bible\CourseMakerController@publish');
	Route::post('course-maker/{course}/update-image','Bible\CourseMakerController@updateImage');
	Route::post('course-maker/{course}/create-section','Bible\CourseMakerController@storeSection');
	Route::post('course-maker/{course}/section/{section}/update','Bible\CourseMakerController@updateSection');
	Route::post('course-maker/{course}/section/{section}/attach-study','Bible\CourseMakerController@attachStudy');
	Route::get('course-maker/{course}','Bible\CourseMakerController@edit');
	Route::post('course-maker/{course}','Bible\CourseMakerController@update');
	Route::get('course-maker/{course}/preview','Bible\CourseMakerController@show');
	
	/*
	 * Course Maker
	 */
	
	Route::get('plan-maker','Bible\PlanMakerController@index');
	Route::post('plan-maker','Bible\PlanMakerController@store');
	Route::get('plan-maker/{plan}','Bible\PlanMakerController@edit');
	Route::post('plan-maker/{plan}','Bible\PlanMakerController@update');
	/*
	 * Comments
	 */
	
	Route::post('comment', [
		'as' => 'comment_path',
		'uses' => 'Bible\CommentsController@store'
	]);
		
});
