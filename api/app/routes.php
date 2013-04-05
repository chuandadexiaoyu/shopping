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

App::bind('ItemRepositoryInterface', 'EloquentItemRepository');
App::bind('VendorRepositoryInterface', 'EloquentVendorRepository');

Route::get('/', array('as'=>'home', 'uses'=>'UsersController@getLogin'));
Route::get('/user/login', array('as'=>'login', 'uses'=>'UsersController@getLogin'));
Route::get('/user/logout', array('as'=>'logout', 'uses'=>'UsersController@getLogout'));

Route::get('/items/{item}/vendors', array('uses'=>'ItemsController@vendors'));
Route::get('/items/{item}/carts', array('uses'=>'ItemsController@carts'));
Route::get('/items/find', array('uses'=>'ItemsController@test'));

Route::get('/vendors/{item}/items', array('uses'=>'VendorsController@items'));

Route::post('/user/login', array('before'=>'csrf', 'uses'=>'UsersController@postLogin'));

Route::resource('users', 'UsersController');
Route::resource('carts', 'CartsController');
Route::resource('accounts', 'AccountsController');
Route::resource('items', 'ItemsController');
Route::resource('vendors', 'VendorsController');
Route::resource('item_vendors', 'ItemVendorsController');
Route::resource('cart_items', 'Cart_itemsController');
