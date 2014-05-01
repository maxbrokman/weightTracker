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

Route::get('/register', array( 'as' => 'register',
    function ()
    {
        return View::make('forms.register');
    }
));

Route::post('/register', array( 'as' => 'register',
    function ()
    {
        $data = Input::all();

        $rules = array(
            'username'  => 'alpha_num|min:3|required',
            'password'  => 'confirmed|min:6|required',
            'email'     => 'email|required'
        );

        $validator = Validator::make($data, $rules);

        if ( $validator->passes() ) {

            $user = New User();
            $user->username     = Input::get('user_name');
            $user->password     = Hash::make( Input::get('password'));
            $user->email        = Input::get('email');

            $user->save();

            Auth::login( $user );

            return Redirect::route('home');

        }

        return Redirect::to('register')->withErrors($validator);
    }
));