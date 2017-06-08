<?php

Route::group(['middleware' => 'web'], function () {

    Route::get('/', ['as'=>'home', 'uses'=>'HomeController@index']);



    Route::post('/get-repository', ['as'=>'get-repository', 'uses'=>'HomeController@getRepositories']);
    Route::post('/', ['as'=>'get-data', 'uses'=>'HomeController@getDataRepository']);

    Route::post('/search', ['as'=>'search', 'uses'=>'SearchGithubController@search']);

    Route::get('/top-repositories', ['as'=>'topRepo', 'uses'=>'BestResultsController@index']);

    Route::get('/subscriptions', ['as'=>'subscriptions', 'uses'=>'SubscriptionsController@index']);
    Route::post('/add-watch', ['as'=>'add-watch', 'uses'=>'SubscriptionsController@add_watch']);
    Route::delete('/del-watch', ['as'=>'del-watch', 'uses'=>'SubscriptionsController@del_watch']);

});
