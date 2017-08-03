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

Route::get('/', function () {
    return view('welcome');
    })->name('public');

/*Social*/
Route::get('/social/handle/{provider}', 'Auth\SocialController@getSocialHandle')->name('handle');
Route::get('/social/redirect/{provider}', 'Auth\SocialController@getSocialRedirect')->name('redirect');

/*Activated*/
Route::group(['prefix' => 'user', 'middleware' => 'auth:user'], function()
{
    Route::group(['middleware' => 'activated'], function ()
    {
        /** User **/

        Route::get('profile', 'UserController@getProfile')->name('profileUser');
        Route::post('update', 'UserController@uploadUser')->name('updateUser');

        /** Stripe **/

        //Subscription Details
        Route::get('subscription/details', 'StripeController@showAccount')->name('details_sub');
        //Update Subscription
        Route::post('update/subscription', 'AccountController@updateSubscription');
        //Update Credit Card
        Route::post('card', 'AccountController@updateCard');
        //Download Invoice
        Route::get('account/invoices/{invoice}', 'AccountController@downloadInvoice');
        //Delete Subscription
        Route::delete('subscription/cancel', 'AccountController@deleteSubscription');
        //Delete Subscription by id
        Route::get('{id}/subscription/cancel', 'AccountController@deleteSubscriptionbyId')->name('suspend_subscription');
        //Proccessing The Subscription
        Route::post('subscribe', 'SubscribeController@processSubscribe');
        
    });

});

/*Authenticated*/
Route::group(['middleware' => 'auth:all'], function()
{
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('/activate/{token}', 'ActivateController@activate')->name('activate');
    Route::get('/activate', 'ActivateController@resend')->name('activation-resend');
    Route::get('not-activated', ['as' => 'not-activated', 'uses' => function () {
        return view('errors.not-activated');
    }]);

});

Auth::routes(['login' => 'auth.login']);


