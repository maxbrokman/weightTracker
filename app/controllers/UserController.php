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
} 