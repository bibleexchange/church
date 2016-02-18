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
/*Route::get('/', function(){
	
	$expenses = [
	
			['1','522','13000',NULL,NULL,'2013-12-24']
	];
	//ACCOUNT','REFERENCE','AMOUNT','PAYEE','CATEGORY','CREATED_AT',
	foreach($expenses AS $expense){

		$e = new Deliverance\Entities\Expense;
		$e->account_id= $expense[0];
		$e->reference= $expense[1];
		$e->amount= $expense[2];
		$e->payee= $expense[3];
		$e->category_id= $expense[4];
		$e->created_at= $expense[5];
		$e->save();
		
	}
	
});*/
Route::get('/', ['uses'=>'PagesController@home','as'=>'home']);
Route::get('/live', ['uses'=>'PagesController@live','as'=>'live']);
Route::get('/archives', ['uses'=>'PagesController@archives','as'=>'archives']);
Route::get('/nav', ['uses'=>'PagesController@nav','as'=>'nav']);

Route::get('/archives/spring-2015', ['uses'=>'PagesController@spr15','as'=>'spr15']);
Route::get('/spring-2015', ['uses'=>'PagesController@spr15','as'=>'spr15']);

Route::get('/news', ['uses'=>'BlogController@index','as'=>'news']);
Route::get('/news/{post}', ['uses'=>'BlogController@show']);

Route::get('/office/contacts/filter/{filter}', 'ContactsController@index');
Route::get('/office/contacts/{id}/attach/{resource}', 'ContactsController@attach');
Route::post('/office/contacts/{id}/attach/{resource}', 'ContactsController@postAttach');
Route::get('/office/deposit/{id}/print', 'DepositsController@printMe');

Route::post('/office/date-selector', ['uses'=>'OfficeController@dateSelector','as'=>'office.date-selector']);
Route::post('/office/gifts/{giftId}', ['uses'=>'GiftsController@update','as'=>'update_gift']);

Route::resource('/office/contacts', 'ContactsController');
Route::resource('/office/address', 'AddressController');
Route::resource('/office/deposit', 'DepositsController');
Route::resource('/office/offerings', 'OfferingsController');
Route::resource('/office/gifts', 'GiftsController');
Route::resource('/office/expenses', 'ExpensesController');
Route::get('/office/mailing', 'AddressController@mailing');
Route::get('/office/missions', 'ContactsController@missions');

Route::Controller('/office', 'OfficeController');