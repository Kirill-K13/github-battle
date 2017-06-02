<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/', ['as'=>'home', 'uses'=>'HomeController@index']);

    Route::post('/get-repository', ['as'=>'get-repository', 'uses'=>'HomeController@getRepository']);
    Route::post('/get-data-repository', ['as'=>'get-data', 'uses'=>'HomeController@getDataRepository']);

});
