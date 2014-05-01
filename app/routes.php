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

Route::get('/', array( 'as' => 'home', 'uses' => 'HomeController@getHome' ));

Route::get('/me', array( 'as' => 'me', 'uses' => 'WeightController@listAll' ));

Route::resource('weight', 'WeightController', array( 'only' => array( 'create', 'store', 'destroy' )));

Route::get('/login', array( 'as' => 'login', 'uses' => 'UserController@getLogin' ));

Route::post('/login', array( 'as' => 'login', 'uses' => 'UserController@postLogin' ));

Route::get('/logout', array( 'as' => 'logout', 'uses' => 'UserController@getLogout' ));

Route::get('/register', array( 'as' => 'register', 'uses' => 'UserController@getRegister' ));

Route::post('/register', array( 'as' => 'register', 'uses' => 'UserController@postRegister' ));