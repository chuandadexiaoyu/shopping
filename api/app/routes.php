<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// Route::resource('itemvendors', 'ItemvendorsController');
// Route::resource('cartitems', 'CartitemsController');



// Route::get('/', array('as' => 'home', 'uses'=>'AuthController@getHomepage'));
// Route::get('login', array('as' => 'login', 'uses'=>'AuthController@getLogin'));
// Route::post('login', array('uses' => 'AuthController@postLogin'));
// Route::get('logout', array('as' => 'logout', 'uses'=>'AuthController@getLogout'));

Route::get('/', array('as' => 'home', function(){
    return View::make('home');
}));


// API Routes ------------------------------------------------------------

Route::group(array('before' => 'api.auth'), function()
{
    // Accounts ----------------------------------------------
    Route::resource('accounts', 'AccountsController');
    Route::get('accounts/{id}/items', array('uses'=>'AccountsController@items'));

    // Carts -------------------------------------------------
    Route::resource('carts', 'CartsController', array(
        'only' => array('index','show','store','update','destroy')));
    Route::get('carts/{id}/items', array('uses'=>'CartsController@items'));
    Route::get('carts/{id}/user', array('uses'=>'CartsController@user'));

    // Items -------------------------------------------------
    Route::resource('items', 'ItemsController', array(
        'only' => array('index','show','store','update','destroy')));
    Route::get('items/{id}/vendors', array('uses'=>'ItemsController@vendors'));
    Route::get('items/{id}/carts', array('uses'=>'ItemsController@carts'));
    Route::get('items/{id}/accounts', array('uses'=>'ItemsController@accounts'));

    // ShoppingDate -------------------------------------------------
    Route::get('dates/next', array('uses'=>'ShoppingDatesController@next'));
    Route::get('dates/{id}/carts', array('uses'=>'ShoppingDatesController@carts'));
    Route::resource('dates', 'ShoppingDatesController', array(
        'only' => array('index','show','store','update','destroy')));

    // Users -------------------------------------------------
    Route::resource('users', 'UsersController', array(
        'only' => array('index','show','store','update','destroy')));
    Route::get('users/{id}/carts', array('uses'=>'UsersController@carts'));

    // Vendors -----------------------------------------------
    Route::resource('vendors', 'VendorsController', array(
        'only' => array('index','show','store','update','destroy')));
    Route::get('vendors/{id}/items', array('uses'=>'VendorsController@items'));

});





