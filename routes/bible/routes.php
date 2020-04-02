<?php

/*
ALL
*/

View::composer('*', function()
{	

	View::share('currentUser', \Auth::user());
	
	
	if(\Auth::check()){
		
		$notifications = new \App\NotificationFetcher(\Auth::user());
		$unReadnotifications = $notifications->onlyUnread()->fetch();
		
		View::share('unReadNotifications',$unReadnotifications);
	}
});

/* ------------------------------------------
 *  Route constraint patterns
 *  ------------------------------------------
*/

Route::pattern('comment', '[0-9]+');
Route::pattern('section', '[0-9]+');
Route::pattern('lesson', '[0-9]+');
Route::pattern('study', '[0-9]+');
Route::pattern('token', '[0-9a-z]+');
Route::pattern('role', '[0-9]+');
Route::pattern('user', '[0-9]+');

Route::model('course', '\App\Course');
Route::model('user', '\App\User');
Route::model('note', '\App\Note');
Route::model('comment', '\App\Comment');
Route::model('lesson', '\App\Lesson');
Route::model('role', '\App\Role');
Route::model('bookmark', '\App\Bookmark');
Route::model('collection', '\App\Collection');
Route::model('ministry', '\App\Ministry');
Route::model('section', '\App\Section');
Route::model('study', '\App\Study');
Route::model('task', '\App\Task');
Route::model('verse', '\App\BibleVerse');
Route::model('bchapter', '\App\BibleChapter');

Route::bind('book', function($value, $route)
{	
	$results = \App\BibleBook::where('slug','like',$value.'%')->first();
	return $results;
});

/*
Search
*/

Route::get('search','Bible\SearchesController@index')->name('search_path');
Route::get('search/data', 'Bible\SearchesController@getData');
Route::get('search/build', ['as' => 'build_search','uses' => 'Bible\SearchesController@build']);
Route::resource('search', 'Bible\SearchesController');

/*
AUTH
*/

Route::get('logout',  'Auth\LoginController@logout');
/*
Route::get('/login', [
	'as' => 'login',
	'uses' => 'Bible\BibleController@getIndex'
]);

Route::post('/login', [
	'as' => 'login',
	'uses' => 'Bible\SessionsController@store'
]);


*/
/*
 * Registration!
*/

/*
Route::get('/register', [
    'as' => 'register',
    'uses' => 'Bible\RegistrationController@create'
]);
*/

Route::get('/register/request-confirmation-email', 'Bible\RegistrationController@requestConfirmationEmail');

Route::get('/register/{confirmation_code}', [
    'as' => 'confirm_path',
    'uses' => 'Bible\RegistrationController@confirmUser'
])->where('confirmation_code','(.*)'); 

Route::post('/register', [
    'as' => 'register',
    'uses' => 'Bible\RegistrationController@store'
]);

Route::post('/confirm_email', ['uses'=>'Bible\RegistrationController@confirmEmailAgain','as'=>'confirm_email']);

/*
HOLY BIBLE ROUTES
*/

Route::get('/bible', array('before' => 'detectLang','uses' => 'Bible\BibleController@index'));
Route::get('bible/{book}', 'Bible\BibleController@getBook');
Route::post('bible/search', 'Bible\BibleController@getSearch');
Route::get('bible/search', 'Bible\BibleController@getSearch');

Route::get('bible/{book}/{chapter}/{verseByV?}', 'Bible\BibleController@getChapterVerses');
Route::get('bible/{book}_{chapter}_{verseByV}', 'Bible\BibleController@getVerse');
Route::post('bible/{book}/{chapter}', 'Bible\BibleController@prevNextChapter');
Route::post('bible/verse', 'Bible\BibleController@postVerse');

include('routes_2.php');
