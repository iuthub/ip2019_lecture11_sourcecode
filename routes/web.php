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

Route::get('/', [
		'uses'=>'PostsController@getIndex',
		'as'=>'index'
	]);

Route::group([
	'prefix'=>'admin',
	'middleware'=>['auth']
], function(){
	
	Route::get('/', [
		'uses'=>'PostsController@getAdminIndex',
		'as'=>'admin.index'
	]);

	Route::post('/new', [
		'uses'=>'PostsController@postAdminNew',
		'as'=>'admin.new_post'
	]);

	Route::get('/delete/{id}', [
		'uses'=>'PostsController@getAdminDelete',
		'as'=>'admin.delete'
	]);

	Route::get('/edit/{id}', [
		'uses'=>'PostsController@getAdminEdit',
		'as'=>'admin.edit'
	]);

	Route::post('/edit', [
		'uses'=>'PostsController@postAdminEdit',
		'as'=>'admin.edit_post'
	]);
});


Auth::routes();
