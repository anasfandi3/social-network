<?php

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
use Psy\Command\EditCommand;
use Symfony\Component\HttpFoundation\Request;

Route::group(['middleware' => ['web']], function(){
	Route::get('/', function () {
	    return view('content');
	})->name('home');

	Route::post('/signup', [
		'uses' => 'UserController@postSignUp',
		'as' => 'signup'
	]);

    Route::post('/signin', [
		'uses' => 'UserController@postSignIn',
		'as' => 'signin'
	]);

	Route::get('/logout',[
		'uses' => 'UserController@getLogout',
		'as' => 'logout'
	]);

	Route::get('/account', [
		'uses' => 'userController@getAccount',
		'as' => 'account'
	])->middleware('auth');

    Route::get('/dashboard', [
        'uses'=> 'PostController@getDashboard',
        'as' => 'dashboard'
	])->middleware('auth');
	
	Route::post('/createpost',[
		'uses' => 'PostController@postCreatePost',
		'as' => 'create.post'
	])->middleware('auth');
	
	Route::get('/delete-post/{post_id}',[
		'uses' => 'PostController@getDeletePost',
		'as' => 'delete.post'
	])->middleware('auth');

	Route::post('/edit',[
		'uses' => 'PostController@postEditPost',
		'as' => 'edit'
	])->middleware('auth');

	Route::post('/updateaccount',[
		'uses' => 'userController@postSaveAccount',
		'as' => 'account.save'
	])->middleware('auth');

	Route::get('/userimage/{filename}', [
		'uses' => 'UserController@getUserImage',
		'as' => 'account.image'
	])->middleware('auth');

	Route::post('/like', [
		'uses' => 'PostController@postLikePost',
		'as' => 'like'
	])->middleware('auth');
});
	
