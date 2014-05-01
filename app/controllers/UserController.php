<?php
/**
 * Created by PhpStorm.
 * User: maxbrokman
 * Date: 01/05/2014
 * Time: 16:27
 */

class UserController extends BaseController {
    public function getLogin()
    {
        $sessionError = Session::get('form_error');
        $formErrors = array();

        if ( !empty( $sessionError ) ) {
            $formErrors[] = $sessionError;
        }
        $data = array(
            'form_errors' => $formErrors
        );
        return View::make('forms.login', $data);
    }

    public function postLogin()
    {
        $credentials    = Input::only('username', 'password');
        $remember       = Input::has('remember');

        if ( Auth::attempt( $credentials, $remember ) ) {
            Session::flash('message', 'Logged In!');
            return Redirect::intended('/');
        }

        Session::flash('form_error', 'Username / Password not recognised');
        return Redirect::route('login');
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flash('message', 'Logged Out!');
        return Redirect::route('home');
    }

    public function getRegister()
    {
        return View::make('register');
    }

    public function postRegister()
    {
        $data = Input::all();

        $rules = array(
            'username'  => 'alpha_num|min:3|required|unique:users',
            'password'  => 'confirmed|min:6|required',
            'email'     => 'email|required|unique:users'
        );

        $validator = Validator::make($data, $rules);

        if ( $validator->passes() ) {

            $user = New User();
            $user->username     = Input::get('username');
            $user->password     = Hash::make( Input::get('password'));
            $user->email        = Input::get('email');

            $user->save();

            Auth::login( $user );

            return Redirect::route('home');

        }

        return Redirect::to('register')->withErrors($validator);
    }
} 