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

Route::get('/', array('as' => 'home', 'uses'=>'HomeController@getHomepage'));
Route::get('login', array('as' => 'login', 'uses'=>'AuthController@getLogin'));
Route::post('login', array('uses' => 'AuthController@postLogin'));
Route::get('logout', array('as' => 'logout', 'uses'=>'AuthController@getLogout'));

Route::get('/entry', array('as' => 'entry', 'uses'=>'EntryController@index'));
Route::get('/report', array('as' => 'report', 'uses'=>'ReportController@index'));

// Admin functions
Route::group(array('before' => 'auth.admin'), function()
{
    Route::get('/admin', array('as' => 'admin', 'uses'=>'AdminController@index'));
    Route::delete('/admin', array('uses'=>'AdminController@destroy'));
    Route::put('/admin', array('uses'=>'AdminController@update'));
});
