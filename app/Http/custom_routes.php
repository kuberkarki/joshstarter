<?php

/* custom routes generated by CRUD */Route::group(array('prefix' => 'admin', 'middleware' => ['web','SentinelAdmin']), function () {Route::resource('girls', 'GirlsController');
	Route::get('girls/{id}/delete', array('as' => 'admin.girls.delete', 'uses' => 'GirlsController@getDelete'));
	Route::get('girls/{id}/confirm-delete', array('as' => 'admin.girls.confirm-delete', 'uses' => 'GirlsController@getModalDelete'));
});Route::group(array('prefix' => 'admin', 'middleware' => ['web','SentinelAdmin']), function () {Route::resource('girls', 'GirlsController');
	Route::get('girls/{id}/delete', array('as' => 'admin.girls.delete', 'uses' => 'GirlsController@getDelete'));
	Route::get('girls/{id}/confirm-delete', array('as' => 'admin.girls.confirm-delete', 'uses' => 'GirlsController@getModalDelete'));
});Route::group(array('prefix' => 'admin', 'middleware' => ['web','SentinelAdmin']), function () {Route::resource('girls', 'GirlsController');
	Route::get('girls/{id}/delete', array('as' => 'admin.girls.delete', 'uses' => 'GirlsController@getDelete'));
	Route::get('girls/{id}/confirm-delete', array('as' => 'admin.girls.confirm-delete', 'uses' => 'GirlsController@getModalDelete'));
});Route::group(array('prefix' => 'admin', 'middleware' => ['web','SentinelAdmin']), function () {Route::resource('events', 'EventsController');
	Route::get('events/{id}/delete', array('as' => 'admin.events.delete', 'uses' => 'EventsController@getDelete'));
	Route::get('events/{id}/confirm-delete', array('as' => 'admin.events.confirm-delete', 'uses' => 'EventsController@getModalDelete'));
});