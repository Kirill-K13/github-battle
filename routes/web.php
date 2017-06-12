<?php

Auth::routes();

Route::group(['middleware' => ['web', 'auth']], function () {

    Route::get('/', ['uses'=>'HomeController@index']);
    Route::get('/home', ['as'=>'home', 'uses'=>'HomeController@index']);
    Route::post('/get-repository', ['as'=>'get-repository', 'uses'=>'HomeController@getRepositories']);
    Route::post('/', ['as'=>'get-data', 'uses'=>'HomeController@getDataRepository']);

    Route::post('/search', ['as'=>'search', 'uses'=>'SearchGithubController@search']);

    Route::get('/top-repositories', ['as'=>'topRepo', 'uses'=>'BestResultsController@index']);

    Route::get('/tracking', ['as'=>'tracking', 'uses'=>'TrackingController@index']);
    Route::post('/add-watch', ['as'=>'add-watch', 'uses'=>'TrackingController@add_watch']);
    Route::delete('/del-watch', ['as'=>'del-watch', 'uses'=>'TrackingController@del_watch']);
    Route::post('/add-follow', ['as'=>'add-follow', 'uses'=>'TrackingController@add_follow']);
    Route::delete('/del-follow', ['as'=>'del-follow', 'uses'=>'TrackingController@del_follow']);


    Route::get('/personal-area', ['as'=>'cabinet', 'uses'=>'AreaController@index']);

    Route::get('/plan/{id}', ['as'=>'plan', 'uses'=>'PlanController@show']);
    Route::post('/subscribe', ['as'=>'subscribe', 'uses'=>'PlanController@subscribe']);
    Route::get('/cancel',  ['as'=>'confirmCancellation', 'uses'=>'PlanController@confirmCancellation']);
    Route::post('/cancel', ['as'=>'subscriptionCancel', 'uses'=>'PlanController@cancelSubscription']);
    Route::post('/resume', ['as'=>'subscriptionResume', 'uses'=>'PlanController@resumeSubscription']);

    Route::get('/invoices', ['as'=>'invoices', 'uses'=>'InvoiceController@index']);
    Route::get('/invoice/{id}', ['as'=>'downloadInvoice', 'uses'=>'InvoiceController@download']);

});



// Handling Stripe Webhooks
Route::post(
    'stripe/webhook',
    '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);
