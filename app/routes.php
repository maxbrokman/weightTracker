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

Route::get('/', array( 'as' => 'home',
    function()
    {
	    if ( !Auth::guest() ) {
            return Redirect::action('WeightController@listAll');
        }
    }
));

Route::get('/me', 'WeightController@listAll' );

Route::resource('weight', 'WeightController', array( 'only' => array( 'create', 'store', 'destroy' )));

Route::get('/login', array( 'as' => 'login',
    function()
    {
        return View::make('forms.login');
    }
));

Route::post('/login', array( 'as' => 'login',
    function()
    {
        $credentials    = Input::only('username', 'password');
        $remember       = Input::has('remember');


        if ( Auth::attempt( $credentials, $remember ) ) {
            return Redirect::intended('/');
        }

        return Redirect::route('login');
    }
));

Route::get('/logout', array( 'as' => 'logout',
    function()
    {
        Auth::logout();
        return Redirect::route('home');
    }
));

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