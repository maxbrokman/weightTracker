<?php

class HomeController extends BaseController {

    /**
     * Homepage controller, calls landing page or /me depending on if the user is logged in or nor
     */
    public function getHome()
    {
        if ( !Auth::guest() ) {
            //return Redirect::route('me');
        }

        return View::make('homepage.landing');
    }


}
