<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/', ['as'=>'home', 'uses'=>'HomeController@index']);

});
