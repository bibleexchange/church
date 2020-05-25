<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(['verify' => true]);

/*
OLD AUTH ROUTES:

Route::get('/register/request-confirmation-email', 'RegistrationController@requestConfirmationEmail');

Route::get('/register/{confirmation_code}', [
    'as' => 'confirm_path',
    'uses' => 'RegistrationController@confirmUser'
])->where('confirmation_code','(.*)'); 

Route::post('/register', [
    'as' => 'register',
    'uses' => 'RegistrationController@store'
]);

Route::post('/confirm_email', ['uses'=>'RegistrationController@confirmEmailAgain','as'=>'confirm_email']);

Route::get('logout',  'Auth\LoginController@logout');

Route::get('/login', [
	'as' => 'login',
	'uses' => 'BibleController@getIndex'
]);

Route::post('/login', [
	'as' => 'login',
	'uses' => 'SessionsController@store'
]);

Route::get('/register', [
    'as' => 'register',
    'uses' => 'RegistrationController@create'
]);

*/

Route::resource('/resource/activity', 'ActivityController');
Route::resource('/resource/comment', 'CommentController');
Route::resource('/resource/user-experience', 'UserExperienceController');
Route::resource('/resource/text', 'TextController');
Route::resource('/u', 'UrlShortController');

Route::resource('/media', 'MediaController');
Route::resource('/images', 'MediaController');
Route::resource('/classroom', 'ClassroomController');
Route::resource('/series', 'SeriesController');
Route::resource('/course', 'CourseController');
Route::resource('/lesson', 'LessonController');
Route::resource('/library', 'LibraryController');
Route::resource('/ministry', 'MinistryController');
Route::resource('/user', 'UserController');

Route::get('/', 'MinistryController@dc')->name('dc');
Route::get('/live', 'MinistryController@live')->name('live');
Route::get('/sermons', 'MinistryController@sermons')->name('sermons');

Route::get('/home', 'UserController@home')->name('home');
Route::get('/home/settings', 'UserSettingsController@index')->name('settings.index');
Route::post('/home/settings', 'UserSettingsController@store')->name('settings.store');

Route::get('/gallery','MediaController@index');
Route::post('/gallery','MediaController@copyImageToSession');

Route::get('/images/{name}','MediaController@showImage')->where('name','.*');
Route::get('/svg/{src1}/{src2?}/{src3?}/{src4?}','MediaController@svg');

Route::get('/images','MediaController@index');
Route::post('/images','MediaController@copyImageToSession');

/*
Blog Routes
*/

//Route::resource('blog', 'BlogController');
///Route::get('/blog/{courseId}/{lessonId}','BlogController@lesson');
//Route::get('/tag/{tag}','BlogController@tagIndex');

/*
Bible Routes
*/


/*
ALL
*/

View::composer('*', function()
{   

    View::share('currentUser', \Auth::user());
    
    
    if(\Auth::check()){
        
        $notifications = new \App\Helpers\Fetch\NotificationFetcher();
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
Route::pattern('token', '[0-9a-z]+');
Route::pattern('role', '[0-9]+');
Route::pattern('user', '[0-9]+');

Route::model('course', '\App\ClassroomSeriesCourse');
Route::model('user', '\App\User');
Route::model('note', '\App\Note');
Route::model('comment', '\App\Comment');
Route::model('lesson', '\App\Lesson');
Route::model('role', '\App\UserRole');
Route::model('bookmark', '\App\Bookmark');
Route::model('collection', '\App\Collection');
Route::model('ministry', '\App\Ministry');
Route::model('section', '\App\Section');
Route::model('study', '\App\Study');
Route::model('task', '\App\Task');
Route::model('verse', '\App\BibleVerse');
Route::model('bchapter', '\App\BibleChapter');

/*
Search
*/

Route::get('search','SearchesController@index')->name('search_path');
Route::get('search/data', 'SearchesController@getData');
Route::get('search/build', ['as' => 'build_search','uses' => 'SearchesController@build']);
Route::resource('search', 'SearchesController');

/*
HOLY BIBLE ROUTES
*/

Route::get('/bible', array('before' => 'detectLang','uses' => 'BibleController@index'));
Route::post('bible/search', 'BibleController@getSearch');
Route::get('bible/search', 'BibleController@getSearch');

Route::get('bible/{book}/{chapter}/{verseByV?}', 'BibleController@getChapterVerses');
Route::get('bible/{book}_{chapter}_{verseByV}', 'BibleController@versesByReference');
Route::post('bible/{book}/{chapter}', 'BibleController@prevNextChapter');
Route::post('bible/verse', 'BibleController@postVerse');
Route::get('bible/{reference}', 'BibleController@versesByReference');

Validator::resolver(function($translator, $data, $rules, $messages)
{
    return new App\Services\CustomValidator($translator, $data, $rules, $messages);
});


/*
 * Notes
*/
Route::get('notes', [
    'as' => 'notes_path',
    'uses' => 'NotesController@index'
]);

Route::post('notes', [
    'as' => 'notes_path',
    'uses' => 'NoteController@store'
]);

/*
 * Users
*/

Route::get('members', [
'as' => 'users_path',
'uses' => 'UsersController@index'
]);

Route::get('@{username}', [
'as' => 'profile_path',
'uses' => 'UsersController@show'
]);

Route::get('@{username}/notes', [
'as' => 'public_notes_path',
'uses' => 'UsersController@notes'
]);

Route::get('@{username}/notes/{note}', [
'as' => 'public_note_path',
'uses' => 'UsersController@note'
]);

Route::get('@{username}/amens', [
'as' => 'public_amens_path',
'uses' => 'UsersController@amens'
]);

Route::get('@{username}/following', [
'as' => 'public_following_path',
'uses' => 'UsersController@following'
]);

Route::get('@{username}/followers', [
'as' => 'public_followers_path',
'uses' => 'UsersController@followers'
]);

Route::get('@{username}/studies','LessonController@userIndex');
Route::get('@{username}/studies/{user_study}','LessonController@studySpace');

Route::get('@{username}/courses','UserCoursesController@index');

/**
 * Follows
*/
Route::post('follows', [
'as' => 'follows_path',
'uses' => 'FollowsController@store'
]);

Route::delete('/follows/{id}', [
'as' => 'follow_path',
'uses' => 'FollowsController@destroy'
]);

/*
 * Password Resets
*/
Route::get('password/remind', 'RemindersController@getRemind');
Route::post('password/remind', 'RemindersController@postRemind');
Route::get('password/reset/{token}', 'RemindersController@getReset')
    ->where('token','(.*)');
    
Route::post('password/reset/{token}', 'RemindersController@postReset')
    ->where('token','(.*)');
    
@include('routes_user.php');
@include('routes_user_content.php');

Route::resource('subscribe', 'UserSubscriptionController');

/*Studies start*/

Route::get('/study','LessonController@index');

Route::get('s/',function(){
    return Redirect::to('/study');
});

Route::post('study/search/{query}', ['as' => 'go_to_study','uses' => 'LessonController@goToStudy']);
Route::get('study/tag/{tag}', ['uses' => 'LessonController@showTag']);
Route::get('study/{study}-{sub1?}','LessonController@studySpace');

/*Studies end*/

/** ------------------------------------------
 *  Admin Routes
 *  ------------------------------------------
 */

Route::group(['prefix' => 'admin', 'before' => 'auth|admin'], function()
{
    //Route::resource('resouces/{name}', 'AdminResourcesController');
    Route::get('/mailer', 'Admin\AdminUserController@mailer');
});

/* Admin end */

Route::get('/rss', 'RssController@getIndex');

Route::get('/course/{course}/rss', 'RssController@getFeed');
Route::get('/course/{course}-{courseTitle}', 'CourseController@show');
Route::get('/courses', 'CourseController@index');

Route::get('study/{studythis}','LessonController@studySpace')
->where('studythis','(.*)');

Route::get('{studythis}','SearchesController@findSomething')
    ->where('studythis','(.*)');



