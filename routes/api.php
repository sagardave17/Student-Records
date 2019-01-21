<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

		Route::resource('users', 'UsersController', ['except'         => ['create', 'edit']]);
		Route::resource('semesters', 'SemestersController', ['except' => ['create', 'edit']]);
		Route::resource('subjects', 'SubjectsController', ['except'   => ['create', 'edit']]);
		Route::resource('marks', 'MarksController', ['except'         => ['create', 'edit']]);
		Route::resource('degrees', 'DegreesController', ['except'     => ['create', 'edit']]);
		Route::post('user/register', 'APIRegisterController@register');
		Route::post('user/login', 'APILoginController@login');
	});

	Route::middleware('jwt.auth')->get('usersdetails', function(Request $request) {   	
	    return auth()->user();
	});

