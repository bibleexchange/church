<?php
/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */
Route::group(array('prefix' => 'admin', 'before' => 'auth|admin'), function()
{
	# Audio Management
	Route::get('audios', 'Bible\AdminAudiosController@index');
	Route::post('audios', 'Bible\AdminAudiosController@store');
	Route::post('audios/{audio}/update', 'Bible\AdminAudiosController@update');
	
	# Comment Management
    Route::get('comments/{comment}/edit', 'Bible\AdminCommentsController@getEdit');
    Route::post('comments/{comment}/edit', 'Bible\AdminCommentsController@postEdit');
    Route::get('comments/{comment}/delete', 'Bible\AdminCommentsController@getDelete');
    Route::post('comments/{comment}/delete', 'Bible\AdminCommentsController@postDelete');
    // This function no longer works needs to be upgraded
    //Route::controller('comments', 'Bible\AdminCommentsController');

    # Lesson Management
    Route::get('lessons/{lesson}/show', 'Bible\AdminLessonsController@getShow');
    Route::get('lessons/{lesson}/edit', 'Bible\AdminLessonsController@getEdit');
    Route::post('lessons/{lesson}/edit', 'Bible\AdminLessonsController@postEdit');
	Route::get('lessons/{lesson}/publish', 'Bible\AdminLessonsController@getPublish');
    Route::get('lessons/{lesson}/delete', 'Bible\AdminLessonsController@getDelete');
    Route::post('lessons/{lesson}/delete', 'Bible\AdminLessonsController@postDelete');
    // This function no longer works needs to be upgraded
    //Route::controller('lessons', 'Bible\AdminLessonsController');
	
	# Course Management
    Route::get('courses/{course}/show', 'Bible\AdminCoursesController@getShow');
    Route::get('courses/{course}/edit', 'Bible\AdminCoursesController@getEdit');
    Route::post('courses/{course}/edit', 'Bible\AdminCoursesController@postEdit');
    Route::get('courses/{course}/delete', 'Bible\AdminCoursesController@getDelete');
    Route::post('courses/{course}/delete', 'Bible\AdminCoursesController@postDelete');
    // This function no longer works needs to be upgraded
    //Route::controller('courses', 'Bible\AdminCoursesController');
	
	# Plans Managament
	Route::get('plans/data', 'Bible\AdminPlansController@getData');
	Route::resource('plans', 'Bible\AdminPlansController');
	
	# Transcripts Management
	Route::resource('transcripts', 'Bible\AdminTranscriptsController');
	
    # User Management
    Route::get('users/{user}/show', 'Bible\AdminUsersController@getShow');
    Route::get('users/{user}/edit', 'Bible\AdminUsersController@getEdit');
    Route::post('users/{user}/edit', 'Bible\AdminUsersController@postEdit');
    Route::get('users/{user}/delete', 'Bible\AdminUsersController@getDelete');
    Route::post('users/{user}/delete', 'Bible\AdminUsersController@postDelete');
    // This function no longer works needs to be upgraded
    //Route::controller('users', 'Bible\AdminUsersController');

    # User Role Management
    Route::get('roles/{role}/show', 'Bible\AdminRolesController@getShow');
    Route::get('roles/{role}/edit', 'Bible\AdminRolesController@getEdit');
    Route::post('roles/{role}/edit', 'Bible\AdminRolesController@postEdit');
    Route::get('roles/{role}/delete', 'Bible\AdminRolesController@getDelete');
    Route::post('roles/{role}/delete', 'Bible\AdminRolesController@postDelete');
    // This function no longer works needs to be upgraded
    //Route::controller('roles', 'Bible\AdminRolesController');
	
    # Admin Dashboard
    // This function no longer works needs to be upgraded
    //Route::controller('/', 'Bible\AdminDashboardController');
	
});
