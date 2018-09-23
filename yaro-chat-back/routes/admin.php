<?php

Route::group(['prefix' => 'admin' , 'namespace' => 'Admin'], function(){
	
	Config::set('auth.defaults.guard', 'admin');
	Config::set("auth.defaults.passwords","admins");

	Route::group(['middleware' => 'notadmin:admin'], function(){
		Route::get('login', 'AdminAuth@login');
		Route::post('login', 'AdminAuth@loginPost');	

		Route::get('forget_password', 'AdminAuth@forget_password');
		Route::post('forget_password', 'AdminAuth@forget_password_post');	

		Route::get('reset/password/{token}', 'AdminAuth@reset_password');
		Route::post('reset/password/{token}', 'AdminAuth@reset_password_post');	
	});
	

	Route::group(['middleware' => 'admin:admin'], function(){
		
		Route::get('home', 'AdminAuth@home');
		Route::get('logout', 'AdminAuth@logout');

		Route::resource('admins', 'AdminController');
		Route::delete('admins/destroy/all', 'AdminController@destroy_all');

		Route::resource('users', 'UserController');
		Route::delete('users/destroy/all', 'UserController@destroy_all');

		Route::resource('groups', 'GroupController');
		Route::delete('groups/destroy/all', 'GroupController@destroy_all');

		Route::get('settings', 'SettingController@index');
		Route::post('settings', 'SettingController@save_settings');

	});
	
});