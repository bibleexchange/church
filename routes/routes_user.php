<?php

Route::group(['prefix' => 'user', 'before' => 'auth'], function()
{
	Route::get('notes', 'UserController@getNotes');
	Route::get('notes/{note}/show', 'NoteController@show');
	Route::get('note/{note}/delete', 'NoteController@delete');
	Route::get('notes/data', 'NotesController@data');	
	Route::get('comment/{comment}/delete', 'CommentsController@delete');
	Route::get('settings', ['use'=>'UserSettingsController@index']);
	Route::post('settings', ['use'=>'UserSettingsController@store','as'=>'settings_path']);
	Route::post('profile-image-delete', 'UserSettingsController@deleteProfileImage');

	Route::get('bookmarks/{bookmark}/delete', 'UserBookmarksController@delete');
	Route::post('bookmarks', 'UserBookmarksController@store');
	Route::get('bookmarks/data', 'UserBookmarksController@data');
	Route::resource('bookmarks', 'UserBookmarksController');
	Route::post('highlight', ['as'=>'highlight_verse','uses'=>'UserHighlightsController@store']);
	Route::post('courses','UserCoursesController@store');
	
	/*
	 * Amens
	 */
	Route::post('amens', [
	'as' => 'amens_path',
	'uses' => 'AmensController@store'
	]);
	
	Route::delete('amens/{id}', [
	'as' => 'amen_path',
	'uses' => 'AmensController@destroy'
	]);
	
	/*
	 * User Notifications
	 */
	Route::get('notifications', [
	'as' => 'notifications_path',
	'uses' => 'UserNotificationsController@index'
	]);
	
	Route::post('notifications', [
		'as' => 'read_notifications_path',
		'uses' => 'UserNotificationsController@userReadNotifications'
	]);
	
	/*
	 * Study Maker
	 */
	
	Route::get('study-maker','LessonController@index');
	Route::post('study-maker', ['as' => 'go_to_user_study','uses' => 'LessonController@goToStudy']);
	
	Route::get('study-maker/{name}/create', [
			'uses'=>'LessonController@create',
			'as'=>'create_study'
			])
			->where('name','(.*)');
	Route::post('study-maker/{name}/create', [
			'uses'=>'LessonController@store',
			'as'=>'create_study'
			])
			->where('name','(.*)');
	
	Route::get('/study-maker/{study}','LessonController@edit');
	Route::get('/study-maker/{study}/edit','LessonController@edit');
	Route::post('/study-maker/{study}/edit','LessonController@update');
	Route::post('/study-maker/{study}/publish','LessonController@publish');
	Route::post('/study-maker/{study}/privatize','LessonController@hideOrShow');
	Route::get('/study-maker/{study}/preview','LessonController@preview');
	
	Route::post('/study-maker/upload-text-file','LessonController@uploadTextFile');
	Route::post('/study-maker/{study}/update-main-verse','LessonController@updateMainVerse');
	Route::post('/study-maker/{study}/update-tags','TagsController@update');
	Route::post('/study-maker/{study}/update-description','LessonController@updateDescription');
	Route::post('/study-maker/{study}/upload-study-icon','LessonController@updateStudyIcon');
	Route::post('/study-maker/{study}/edit-title','LessonController@updateTitle');
	Route::post('/study-maker/{study}/recording/{recording}/detach','LessonController@detachRecording');
	
	Route::post('study-maker/{study}/create-task','LessonController@storeTask');
	Route::post('study-maker/{study}/task/{task}/update','LessonController@updateTask');
	Route::get('study-maker/{study}/task/{task}/edit','LessonController@editTask');
	
	Route::post('study-maker/{study}/task/{task}/store-question','QuestionsController@store');
	Route::post('study-maker/{study}/task/{task}/update-question','QuestionsController@update');
	
	Route::post('course-maker/attach-task-property',[
		'uses'=>'LessonController@attachTaskProperty',
		'as' => 'attach_study'
				]);
	
	/*
	 * Course Maker
	 */
			
	Route::get('course-maker','CourseMakerController@index');
	Route::post('course-maker','CourseMakerController@store');
	Route::post('/course-maker/{course}/publish','CourseMakerController@publish');
	Route::post('course-maker/{course}/update-image','CourseMakerController@updateImage');
	Route::post('course-maker/{course}/create-section','CourseMakerController@storeSection');
	Route::post('course-maker/{course}/section/{section}/update','CourseMakerController@updateSection');
	Route::post('course-maker/{course}/section/{section}/attach-study','CourseMakerController@attachStudy');
	Route::get('course-maker/{course}','CourseMakerController@edit');
	Route::post('course-maker/{course}','CourseMakerController@update');
	Route::get('course-maker/{course}/preview','CourseMakerController@show');
	
	/*
	 * Course Maker
	 */
	
	Route::get('plan-maker','PlanMakerController@index');
	Route::post('plan-maker','PlanMakerController@store');
	Route::get('plan-maker/{plan}','PlanMakerController@edit');
	Route::post('plan-maker/{plan}','PlanMakerController@update');
	/*
	 * Comments
	 */
	
	Route::post('comment', [
		'as' => 'comment_path',
		'uses' => 'CommentsController@store'
	]);
		
});
