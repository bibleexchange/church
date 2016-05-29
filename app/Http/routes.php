<?php

use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;

View::composer('*', function()
{
	View::share('currentUser', \Auth::user());
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController'
]);

Route::model('user', 'Deliverance\Entities\User');

Route::get('/', ['uses'=>'PagesController@home','as'=>'home']);
Route::get('/live', ['uses'=>'PagesController@live','as'=>'live']);
Route::get('/archives', ['uses'=>'PagesController@archives','as'=>'archives']);
Route::get('/nav', ['uses'=>'PagesController@nav','as'=>'nav']);

Route::get('/archives/spring-2015', ['uses'=>'PagesController@spr15','as'=>'spr15']);
Route::get('/spring-2015', ['uses'=>'PagesController@spr15','as'=>'spr15']);
Route::get('/spring-convention', ['uses'=>'PagesController@spr15','as'=>'spring']);

Route::get('/news', ['uses'=>'BlogController@index','as'=>'news']);
Route::get('/news/{post}', ['uses'=>'BlogController@show']);