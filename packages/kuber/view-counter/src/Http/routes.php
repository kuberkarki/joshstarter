<?php

Route::get('like/{class_name}/{object_id}', array('uses' => '\Kuber\ViewCounter\LikeController@like', 'as' => 'view_counter.like'))
->where('object_id', '[0-9]+');
Route::get('unlike/{class_name}/{object_id}', array('uses' => '\Kuber\ViewCounter\LikeController@unlike', 'as' => 'view_counter.unlike'))
->where('object_id', '[0-9]+');